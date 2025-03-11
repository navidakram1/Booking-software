<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingRule;
use Carbon\Carbon;

class BookingRulesSeeder extends Seeder
{
    public function run()
    {
        $rules = [
            [
                'name' => 'Advance Booking Limit',
                'rule_type' => 'time_constraint',
                'value' => '60', // Days
                'description' => 'Maximum days in advance a booking can be made',
                'is_active' => true,
                'applies_to' => 'all',
                'priority' => 1
            ],
            [
                'name' => 'Minimum Notice Period',
                'rule_type' => 'time_constraint',
                'value' => '24', // Hours
                'description' => 'Minimum hours of notice required for a booking',
                'is_active' => true,
                'applies_to' => 'all',
                'priority' => 2
            ],
            [
                'name' => 'Cancellation Period',
                'rule_type' => 'cancellation',
                'value' => '48', // Hours
                'description' => 'Hours before appointment when cancellation is allowed without penalty',
                'is_active' => true,
                'applies_to' => 'all',
                'priority' => 3
            ],
            [
                'name' => 'Reschedule Period',
                'rule_type' => 'reschedule',
                'value' => '24', // Hours
                'description' => 'Hours before appointment when rescheduling is allowed',
                'is_active' => true,
                'applies_to' => 'all',
                'priority' => 4
            ],
            [
                'name' => 'Maximum Active Bookings',
                'rule_type' => 'booking_limit',
                'value' => '3',
                'description' => 'Maximum number of active bookings per customer',
                'is_active' => true,
                'applies_to' => 'customer',
                'priority' => 5
            ],
            [
                'name' => 'Daily Booking Limit',
                'rule_type' => 'booking_limit',
                'value' => '1',
                'description' => 'Maximum number of bookings per day per customer',
                'is_active' => true,
                'applies_to' => 'customer',
                'priority' => 6
            ],
            [
                'name' => 'Buffer Time',
                'rule_type' => 'time_constraint',
                'value' => '15', // Minutes
                'description' => 'Buffer time between appointments',
                'is_active' => true,
                'applies_to' => 'service',
                'priority' => 7
            ],
            [
                'name' => 'Late Arrival Grace Period',
                'rule_type' => 'time_constraint',
                'value' => '10', // Minutes
                'description' => 'Maximum minutes late a customer can arrive',
                'is_active' => true,
                'applies_to' => 'all',
                'priority' => 8
            ],
            [
                'name' => 'Group Booking Size',
                'rule_type' => 'capacity',
                'value' => '5',
                'description' => 'Maximum number of people for a group booking',
                'is_active' => true,
                'applies_to' => 'group',
                'priority' => 9
            ],
            [
                'name' => 'Waitlist Limit',
                'rule_type' => 'capacity',
                'value' => '10',
                'description' => 'Maximum number of people on waitlist per service',
                'is_active' => true,
                'applies_to' => 'service',
                'priority' => 10
            ]
        ];

        foreach ($rules as $rule) {
            BookingRule::create($rule);
        }
    }
} 