<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\AdminBookingNotification;

class BookingController extends Controller
{
    public function index()
    {
        $services = [
            [
                'id' => 1,
                'category' => 'Salon',
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling services for all hair types.',
                'price' => 50.00,
                'duration' => 60,
                'image' => 'images/services/haircut.jpg'
            ],
            [
                'id' => 2,
                'category' => 'Salon',
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring service with premium products.',
                'price' => 120.00,
                'duration' => 120,
                'image' => 'images/services/coloring.jpg'
            ],
            [
                'id' => 3,
                'category' => 'Massage',
                'name' => 'Swedish Massage',
                'description' => 'Relaxing full-body massage.',
                'price' => 80.00,
                'duration' => 60,
                'image' => 'images/services/massage.jpg'
            ],
            [
                'id' => 4,
                'category' => 'Skincare',
                'name' => 'Facial Treatment',
                'description' => 'Deep cleansing facial with premium products.',
                'price' => 90.00,
                'duration' => 60,
                'image' => 'images/services/facial.jpg'
            ]
        ];

        $specialists = [
            [
                'id' => 1,
                'name' => 'Sarah Johnson',
                'role' => 'Senior Hair Stylist',
                'experience' => '8 years',
                'specialties' => ['Haircuts', 'Coloring', 'Styling'],
                'services' => [1, 2], // Service IDs they can perform
                'image' => 'images/specialists/specialist1.jpg',
                'rating' => 4.9
            ],
            [
                'id' => 2,
                'name' => 'Michael Chen',
                'role' => 'Color Specialist',
                'experience' => '6 years',
                'specialties' => ['Balayage', 'Highlights', 'Color Correction'],
                'services' => [2], // Service IDs they can perform
                'image' => 'images/specialists/specialist2.jpg',
                'rating' => 4.8
            ],
            [
                'id' => 3,
                'name' => 'Emily Rodriguez',
                'role' => 'Massage Therapist',
                'experience' => '5 years',
                'specialties' => ['Swedish Massage', 'Deep Tissue', 'Hot Stone'],
                'services' => [3], // Service IDs they can perform
                'image' => 'images/specialists/specialist3.jpg',
                'rating' => 4.9
            ],
            [
                'id' => 4,
                'name' => 'David Kim',
                'role' => 'Skincare Expert',
                'experience' => '7 years',
                'specialties' => ['Facials', 'Skin Treatments', 'Anti-aging'],
                'services' => [4], // Service IDs they can perform
                'image' => 'images/specialists/specialist4.jpg',
                'rating' => 4.7
            ]
        ];

        return view('booking', compact('services', 'specialists'));
    }

    public function getSpecialists($serviceId)
    {
        // Get specialists who can perform this service
        $specialists = collect($this->index()->getData()['specialists'])
            ->filter(function($specialist) use ($serviceId) {
                return in_array($serviceId, $specialist['services']);
            })
            ->values();

        return response()->json($specialists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'specialist_id' => 'required|integer',
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

    public function getAvailableTimeSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'specialist_id' => 'required|integer',
            'service_id' => 'required|integer'
        ]);

        // For development, return dummy time slots
        $timeSlots = [
            '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'
        ];

        return response()->json($timeSlots);
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
