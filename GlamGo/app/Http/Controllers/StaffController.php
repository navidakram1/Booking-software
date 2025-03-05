<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;

class StaffController extends Controller
{
    public function profile()
    {
        // During development, we'll use static data
        // Later this can be fetched from the database
        $staff = [
            'name' => 'Sarah Johnson',
            'role' => 'Senior Hair Stylist',
            'experience' => '5+ years',
            'stats' => [
                'appointments' => 127,
                'rating' => 4.9,
                'years' => 5,
                'reviews' => 89
            ],
            'bio' => 'Passionate hair stylist with 5+ years of experience specializing in color transformations and modern cuts. Certified in advanced coloring techniques and committed to creating personalized looks for each client.',
            'specialties' => [
                'Hair Coloring',
                'Balayage',
                'Modern Cuts',
                'Styling'
            ],
            'appointments' => [
                [
                    'date' => 'Feb 25',
                    'time' => '10:00 AM',
                    'service' => 'Hair Coloring',
                    'client' => 'Emma Watson'
                ]
            ],
            'workingHours' => [
                'Monday' => '9:00 AM - 6:00 PM',
                'Tuesday' => '9:00 AM - 6:00 PM',
                'Wednesday' => '9:00 AM - 6:00 PM',
                'Thursday' => '9:00 AM - 6:00 PM',
                'Friday' => '9:00 AM - 6:00 PM',
                'Saturday' => '10:00 AM - 4:00 PM',
                'Sunday' => 'Closed'
            ]
        ];

        return view('staff.profile', ['staff' => $staff]);
    }

    public function appointments()
    {
        $bookings = [
            'upcoming' => Booking::with(['user', 'service'])
                ->where('staff_id', auth()->id())
                ->where('start_time', '>=', now())
                ->orderBy('start_time')
                ->get()
                ->map(function($booking) {
                    return [
                        'id' => $booking->id,
                        'date' => $booking->start_time->format('Y-m-d'),
                        'time' => $booking->start_time->format('g:i A'),
                        'duration' => $booking->service->duration,
                        'service' => $booking->service->name,
                        'client' => $booking->user->name,
                        'status' => $booking->status,
                        'price' => $booking->price,
                        'notes' => $booking->notes
                    ];
                }),
            'available_times' => [
                '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'
            ],
            'services' => Service::where('is_active', true)
                ->get()
                ->map(function($service) {
                    return [
                        'id' => $service->id,
                        'name' => $service->name,
                        'duration' => $service->duration,
                        'price' => $service->price
                    ];
                })
        ];

        return view('staff.appointments', ['bookings' => $bookings]);
    }
}
