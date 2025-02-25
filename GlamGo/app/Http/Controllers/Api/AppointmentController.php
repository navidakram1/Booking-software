<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\Specialist;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after:today',
            'specialist_id' => 'nullable|exists:specialists,id'
        ]);

        $date = Carbon::parse($request->date);
        
        $availableSlots = TimeSlot::where('date', $date)
            ->where('is_available', true)
            ->when($request->specialist_id, function($query) use ($request) {
                return $query->where('specialist_id', $request->specialist_id);
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $availableSlots
        ]);
    }

    public function book(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'specialist_id' => 'required|exists:specialists,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string'
        ]);

        // Check if slot is still available
        $isAvailable = TimeSlot::where('specialist_id', $request->specialist_id)
            ->where('date', $request->appointment_date)
            ->where('start_time', $request->appointment_time)
            ->where('is_available', true)
            ->exists();

        if (!$isAvailable) {
            return response()->json([
                'status' => 'error',
                'message' => 'This time slot is no longer available'
            ], 422);
        }

        // Create appointment
        $appointment = Appointment::create($request->all());

        // Update time slot availability
        TimeSlot::where('specialist_id', $request->specialist_id)
            ->where('date', $request->appointment_date)
            ->where('start_time', $request->appointment_time)
            ->update(['is_available' => false]);

        // Send confirmation email (implement this later)
        // event(new AppointmentBooked($appointment));

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully',
            'data' => $appointment
        ]);
    }
}
