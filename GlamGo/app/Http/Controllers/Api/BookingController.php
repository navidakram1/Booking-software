<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function getServices()
    {
        $services = Service::with(['category', 'staff'])
            ->where('is_active', true)
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'category' => $service->category->name,
                    'duration' => $service->duration,
                    'price' => $service->price,
                    'description' => $service->description,
                    'specialists' => $service->staff->map(function ($staff) {
                        return [
                            'id' => $staff->id,
                            'name' => $staff->name,
                            'specialization' => $staff->specialization
                        ];
                    })
                ];
            });

        return response()->json($services);
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date|after:today'
        ]);

        $service = Service::findOrFail($request->service_id);
        $staff = Staff::findOrFail($request->staff_id);
        $date = Carbon::parse($request->date);

        // Get staff working hours for the selected day
        $workingHours = $staff->working_hours[strtolower($date->format('l'))] ?? null;
        if (!$workingHours) {
            return response()->json(['message' => 'Staff not available on this day'], 422);
        }

        // Get all appointments for the selected date and staff
        $bookedSlots = Appointment::where('staff_id', $staff->id)
            ->whereDate('appointment_date', $date)
            ->get()
            ->map(function ($appointment) {
                return [
                    'start' => Carbon::parse($appointment->appointment_time)->format('H:i'),
                    'end' => Carbon::parse($appointment->appointment_time)
                        ->addMinutes($appointment->service->duration)
                        ->format('H:i')
                ];
            });

        // Generate available time slots
        $availableSlots = [];
        $startTime = Carbon::parse($workingHours['start']);
        $endTime = Carbon::parse($workingHours['end']);
        $duration = $service->duration;

        while ($startTime->copy()->addMinutes($duration) <= $endTime) {
            $slotEnd = $startTime->copy()->addMinutes($duration);
            $isAvailable = true;

            foreach ($bookedSlots as $bookedSlot) {
                $bookedStart = Carbon::parse($bookedSlot['start']);
                $bookedEnd = Carbon::parse($bookedSlot['end']);

                if ($startTime < $bookedEnd && $slotEnd > $bookedStart) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = $startTime->format('H:i');
            }

            $startTime->addMinutes(30); // 30-minute intervals
        }

        return response()->json([
            'available_slots' => $availableSlots
        ]);
    }

    public function createAppointment(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:staff,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20'
        ]);

        // Check if the slot is still available
        $isAvailable = $this->checkSlotAvailability(
            $request->staff_id,
            $request->appointment_date,
            $request->appointment_time,
            Service::find($request->service_id)->duration
        );

        if (!$isAvailable) {
            return response()->json(['message' => 'Selected time slot is no longer available'], 422);
        }

        // Create the appointment
        $appointment = DB::transaction(function () use ($request) {
            $appointment = Appointment::create([
                'service_id' => $request->service_id,
                'staff_id' => $request->staff_id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone
            ]);

            // TODO: Send confirmation email
            // TODO: Send SMS notification

            return $appointment;
        });

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);
    }

    private function checkSlotAvailability($staffId, $date, $time, $duration)
    {
        $startTime = Carbon::parse($time);
        $endTime = $startTime->copy()->addMinutes($duration);

        return !Appointment::where('staff_id', $staffId)
            ->whereDate('appointment_date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('appointment_time', '>=', $startTime)
                        ->where('appointment_time', '<', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('appointment_time', '<=', $startTime)
                        ->whereRaw('DATE_ADD(appointment_time, INTERVAL duration MINUTE) > ?', [$startTime]);
                });
            })
            ->exists();
    }
}
