<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Events\ServiceAvailabilityUpdated;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckServiceAvailability;

class ServiceAvailabilityController extends Controller
{
    protected $availabilityChecker;

    public function __construct()
    {
        $this->availabilityChecker = new CheckServiceAvailability();
    }

    public function check(Request $request, Service $service)
    {
        // Create a mock request with the service
        $mockRequest = new Request();
        $mockRequest->merge(['route' => ['service' => $service->id]]);
        
        // Use the middleware to check availability
        $this->availabilityChecker->handle($mockRequest, function($request) {
            return $request;
        });

        $availability = $mockRequest->service_availability;

        // Broadcast the availability update
        event(new ServiceAvailabilityUpdated($service, $availability));

        return response()->json($availability);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'is_available' => 'required|boolean',
            'next_available_slot' => 'nullable|date',
            'available_slots' => 'nullable|array',
            'available_slots.*' => 'date'
        ]);

        // Broadcast the availability update
        event(new ServiceAvailabilityUpdated($service, $validated));

        return response()->json([
            'message' => 'Availability updated successfully',
            'data' => $validated
        ]);
    }
} 