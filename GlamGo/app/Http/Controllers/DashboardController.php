<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy data for development
        $data = [
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'avatar' => 'https://ui-avatars.com/api/?name=John+Doe',
            ],
            'stats' => [
                'total_appointments' => 15,
                'completed_appointments' => 12,
                'upcoming_appointments' => 3,
                'total_reviews' => 8,
            ],
            'upcoming_appointments' => [
                [
                    'id' => 1,
                    'service' => 'Haircut & Styling',
                    'stylist' => 'Jane Smith',
                    'date' => '2025-02-25',
                    'time' => '14:00',
                    'status' => 'confirmed',
                ],
                [
                    'id' => 2,
                    'service' => 'Manicure & Pedicure',
                    'stylist' => 'John Doe',
                    'date' => '2025-03-03',
                    'time' => '10:00',
                    'status' => 'confirmed',
                ],
            ],
            'recent_bookings' => [
                [
                    'id' => 3,
                    'service' => 'Facial Treatment',
                    'stylist' => 'Sarah Johnson',
                    'date' => '2025-02-20',
                    'time' => '15:30',
                    'status' => 'completed',
                ],
                [
                    'id' => 4,
                    'service' => 'Hair Coloring',
                    'stylist' => 'Mike Wilson',
                    'date' => '2025-02-15',
                    'time' => '11:00',
                    'status' => 'completed',
                ],
            ],
        ];

        return view('dashboard', compact('data'));
    }
}
