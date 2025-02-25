<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\AdminBookingNotification;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'service_name' => 'required|string',
            'price' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            // For development, just return success without storing
            return response()->json([
                'status' => 'success',
                'message' => 'Booking confirmed successfully!',
                'booking' => $validated
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        // Dummy data for development
        $services = [
            [
                'id' => 1,
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling services for all hair types.',
                'duration' => '60',
                'price' => 50.00,
                'image' => 'https://images.unsplash.com/photo-1560869713-da86a9ec0744?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80'
            ],
            [
                'id' => 2,
                'name' => 'Manicure & Pedicure',
                'description' => 'Luxurious nail care treatment for hands and feet.',
                'duration' => '90',
                'price' => 75.00,
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80'
            ],
            [
                'id' => 3,
                'name' => 'Facial Treatment',
                'description' => 'Rejuvenating facial treatment for glowing skin.',
                'duration' => '60',
                'price' => 90.00,
                'image' => 'https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80'
            ],
            [
                'id' => 4,
                'name' => 'Hair Coloring',
                'description' => 'Professional hair coloring services.',
                'duration' => '120',
                'price' => 120.00,
                'image' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80'
            ]
        ];

        $stylists = [
            [
                'id' => 1,
                'name' => 'Jane Smith',
                'specialty' => 'Hair Styling',
                'experience' => '8 years',
                'avatar' => 'https://ui-avatars.com/api/?name=Jane+Smith'
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'specialty' => 'Nail Care',
                'experience' => '5 years',
                'avatar' => 'https://ui-avatars.com/api/?name=John+Doe'
            ],
            [
                'id' => 3,
                'name' => 'Sarah Johnson',
                'specialty' => 'Facial Treatments',
                'experience' => '10 years',
                'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Johnson'
            ]
        ];

        $timeSlots = [
            '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
            '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM',
            '05:00 PM', '06:00 PM'
        ];

        return view('booking', compact('services', 'stylists', 'timeSlots'));
    }

    public function show($id)
    {
        // Dummy booking data for development
        $booking = [
            'id' => $id,
            'service_name' => 'Haircut & Styling',
            'stylist_name' => 'Jane Smith',
            'date' => '2025-02-25',
            'time' => '14:00',
            'status' => 'confirmed',
            'price' => 50.00,
            'notes' => 'No specific requirements'
        ];

        return view('bookings.show', compact('booking'));
    }

    public function adminIndex()
    {
        // Dummy data for development
        $bookings = [
            [
                'id' => 1,
                'service_name' => 'Haircut & Styling',
                'stylist_name' => 'Jane Smith',
                'date' => '2025-02-25',
                'time' => '14:00',
                'status' => 'confirmed',
                'price' => 50.00,
                'notes' => 'No specific requirements'
            ],
            [
                'id' => 2,
                'service_name' => 'Manicure & Pedicure',
                'stylist_name' => 'John Doe',
                'date' => '2025-02-26',
                'time' => '10:00',
                'status' => 'pending',
                'price' => 75.00,
                'notes' => 'Special request for nail art'
            ],
            [
                'id' => 3,
                'service_name' => 'Facial Treatment',
                'stylist_name' => 'Sarah Johnson',
                'date' => '2025-02-27',
                'time' => '12:00',
                'status' => 'confirmed',
                'price' => 90.00,
                'notes' => 'No specific requirements'
            ]
        ];

        return view('admin.bookings.index', compact('bookings'));
    }

    public function adminShow($id)
    {
        // Dummy booking data for development
        $booking = [
            'id' => $id,
            'service_name' => 'Haircut & Styling',
            'stylist_name' => 'Jane Smith',
            'date' => '2025-02-25',
            'time' => '14:00',
            'status' => 'confirmed',
            'price' => 50.00,
            'notes' => 'No specific requirements'
        ];

        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        // Dummy booking data for development
        $booking = [
            'id' => $id,
            'service_name' => 'Haircut & Styling',
            'stylist_name' => 'Jane Smith',
            'date' => '2025-02-25',
            'time' => '14:00',
            'status' => $validated['status'],
            'price' => 50.00,
            'notes' => 'No specific requirements'
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Booking status updated successfully',
            'booking' => $booking
        ]);
    }
}
