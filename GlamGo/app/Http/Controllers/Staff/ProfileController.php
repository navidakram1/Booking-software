<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show($id)
    {
        $staff = Staff::with(['services', 'appointments' => function($query) {
            $query->where('appointment_date', '>=', Carbon::today());
        }])->findOrFail($id);

        return response()->json($staff);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,'.$id,
            'phone' => 'required|string|max:20',
            'bio' => 'nullable|string',
            'specialization' => 'required|string|max:255',
            'working_hours' => 'required|array',
            'working_hours.*.start' => 'required|date_format:H:i',
            'working_hours.*.end' => 'required|date_format:H:i|after:working_hours.*.start',
            'profile_image' => 'nullable|image|max:2048',
            'services' => 'required|array|exists:services,id'
        ]);

        $staff = Staff::findOrFail($id);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($staff->profile_image) {
                Storage::delete($staff->profile_image);
            }
            $path = $request->file('profile_image')->store('staff-profiles', 'public');
            $staff->profile_image = $path;
        }

        // Update basic info
        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'specialization' => $request->specialization,
            'working_hours' => $request->working_hours
        ]);

        // Update services
        $staff->services()->sync($request->services);

        return response()->json([
            'message' => 'Profile updated successfully',
            'staff' => $staff->load('services')
        ]);
    }

    public function getAvailability($id)
    {
        $staff = Staff::findOrFail($id);
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(14); // Show next 2 weeks

        $appointments = $staff->appointments()
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->get()
            ->groupBy(function($appointment) {
                return $appointment->appointment_date;
            });

        $availability = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dayOfWeek = strtolower($currentDate->format('l'));
            $workingHours = $staff->working_hours[$dayOfWeek] ?? null;

            if ($workingHours) {
                $dayAppointments = $appointments[$currentDate->format('Y-m-d')] ?? collect();
                $availability[$currentDate->format('Y-m-d')] = [
                    'working_hours' => $workingHours,
                    'booked_slots' => $dayAppointments->map(function($appointment) {
                        return [
                            'start' => $appointment->appointment_time,
                            'end' => Carbon::parse($appointment->appointment_time)
                                ->addMinutes($appointment->service->duration)
                                ->format('H:i')
                        ];
                    })
                ];
            }

            $currentDate->addDay();
        }

        return response()->json($availability);
    }

    public function getPerformanceMetrics($id)
    {
        $staff = Staff::findOrFail($id);
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $metrics = [
            'total_appointments' => $staff->appointments()
                ->whereBetween('appointment_date', [$startDate, $endDate])
                ->count(),
            'completed_appointments' => $staff->appointments()
                ->where('status', 'completed')
                ->whereBetween('appointment_date', [$startDate, $endDate])
                ->count(),
            'total_revenue' => $staff->appointments()
                ->where('status', 'completed')
                ->whereBetween('appointment_date', [$startDate, $endDate])
                ->sum('total_amount'),
            'average_rating' => $staff->reviews()->avg('rating') ?? 0,
            'total_reviews' => $staff->reviews()->count(),
            'service_distribution' => $staff->appointments()
                ->with('service')
                ->whereBetween('appointment_date', [$startDate, $endDate])
                ->get()
                ->groupBy('service.name')
                ->map(function($appointments) {
                    return $appointments->count();
                })
        ];

        return response()->json($metrics);
    }
}
