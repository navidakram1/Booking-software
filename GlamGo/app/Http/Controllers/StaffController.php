<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Sample data for development
        $appointments = [
            'upcoming' => [
                [
                    'id' => 1,
                    'date' => '2025-02-25',
                    'time' => '10:00 AM',
                    'duration' => '60',
                    'service' => 'Hair Coloring',
                    'client' => 'Emma Watson',
                    'status' => 'confirmed',
                    'price' => 120.00,
                    'notes' => 'Full head color, previous color was done 6 weeks ago'
                ],
                [
                    'id' => 2,
                    'date' => '2025-02-25',
                    'time' => '2:00 PM',
                    'duration' => '90',
                    'service' => 'Balayage + Cut',
                    'client' => 'Sophie Turner',
                    'status' => 'pending',
                    'price' => 180.00,
                    'notes' => 'First time client, wants ashy blonde'
                ]
            ],
            'available_times' => [
                '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'
            ],
            'services' => [
                [
                    'id' => 1,
                    'name' => 'Hair Cut',
                    'duration' => 45,
                    'price' => 65.00
                ],
                [
                    'id' => 2,
                    'name' => 'Hair Coloring',
                    'duration' => 60,
                    'price' => 120.00
                ],
                [
                    'id' => 3,
                    'name' => 'Balayage',
                    'duration' => 90,
                    'price' => 150.00
                ],
                [
                    'id' => 4,
                    'name' => 'Styling',
                    'duration' => 30,
                    'price' => 45.00
                ]
            ]
        ];

        return view('staff.appointments', ['appointments' => $appointments]);
    }
}
