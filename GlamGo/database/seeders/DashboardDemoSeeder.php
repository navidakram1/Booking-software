<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Appointment;
use App\Models\ServiceReview;
use App\Models\WorkingHour;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Str;

class DashboardDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Hair Care',
                'description' => 'Professional hair care services including cuts, coloring, and styling',
                'image' => 'categories/hair-care.jpg',
                'slug' => 'hair-care',
                'is_active' => true,
                'order' => 1
            ],
            [
                'name' => 'Skin Care',
                'description' => 'Facial treatments, skin analysis, and personalized skin care routines',
                'image' => 'categories/skin-care.jpg',
                'slug' => 'skin-care',
                'is_active' => true,
                'order' => 2
            ],
            [
                'name' => 'Nail Care',
                'description' => 'Professional nail services including manicures, pedicures, and nail art',
                'image' => 'categories/nail-care.jpg',
                'slug' => 'nail-care',
                'is_active' => true,
                'order' => 3
            ],
            [
                'name' => 'Massage',
                'description' => 'Relaxing massage treatments for stress relief and muscle tension',
                'image' => 'categories/massage.jpg',
                'slug' => 'massage',
                'is_active' => true,
                'order' => 4
            ],
            [
                'name' => 'Makeup',
                'description' => 'Professional makeup services for all occasions',
                'image' => 'categories/makeup.jpg',
                'slug' => 'makeup',
                'is_active' => true,
                'order' => 5
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Services
        $services = [
            // Hair Care Services
            [
                'category_id' => 1,
                'name' => 'Haircut & Styling',
                'description' => 'Professional haircut and styling service customized to your preferences',
                'duration' => 60,
                'price' => 50.00,
                'image' => 'services/haircut.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring service with premium products',
                'duration' => 120,
                'price' => 100.00,
                'image' => 'services/hair-coloring.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Hair Treatment',
                'description' => 'Deep conditioning and repair treatment for damaged hair',
                'duration' => 45,
                'price' => 75.00,
                'image' => 'services/hair-treatment.jpg',
                'is_active' => true
            ],
            // Skin Care Services
            [
                'category_id' => 2,
                'name' => 'Classic Facial',
                'description' => 'Deep cleansing facial with steam and extraction',
                'duration' => 60,
                'price' => 75.00,
                'image' => 'services/facial.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Anti-Aging Treatment',
                'description' => 'Advanced anti-aging facial with premium products',
                'duration' => 75,
                'price' => 120.00,
                'image' => 'services/anti-aging.jpg',
                'is_active' => true
            ],
            // Nail Care Services
            [
                'category_id' => 3,
                'name' => 'Classic Manicure',
                'description' => 'Professional nail care service with regular polish',
                'duration' => 45,
                'price' => 35.00,
                'image' => 'services/manicure.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Gel Pedicure',
                'description' => 'Long-lasting gel polish pedicure with foot massage',
                'duration' => 60,
                'price' => 55.00,
                'image' => 'services/pedicure.jpg',
                'is_active' => true
            ],
            // Massage Services
            [
                'category_id' => 4,
                'name' => 'Swedish Massage',
                'description' => 'Relaxing full body massage with medium pressure',
                'duration' => 60,
                'price' => 80.00,
                'image' => 'services/swedish-massage.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Deep Tissue Massage',
                'description' => 'Therapeutic massage focusing on muscle tension',
                'duration' => 60,
                'price' => 90.00,
                'image' => 'services/deep-tissue.jpg',
                'is_active' => true
            ],
            // Makeup Services
            [
                'category_id' => 5,
                'name' => 'Bridal Makeup',
                'description' => 'Complete bridal makeup with trial session',
                'duration' => 90,
                'price' => 150.00,
                'image' => 'services/bridal-makeup.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Evening Makeup',
                'description' => 'Glamorous evening makeup for special occasions',
                'duration' => 60,
                'price' => 85.00,
                'image' => 'services/evening-makeup.jpg',
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create([
                'category_id' => $service['category_id'],
                'name' => $service['name'],
                'slug' => Str::slug($service['name']),
                'description' => $service['description'],
                'duration' => $service['duration'],
                'price' => $service['price'],
                'image' => $service['image'],
                'is_active' => $service['is_active'],
            ]);
        }

        // Create Specialists
        $specialists = [
            [
                'name' => 'Emily Johnson',
                'title' => 'Master Hair Stylist',
                'bio' => 'Master hair stylist with over 12 years of experience specializing in color transformations and modern cutting techniques. Certified in advanced coloring techniques from Vidal Sassoon.',
                'profile_image' => 'specialists/emily-johnson.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Sarah Chen',
                'title' => 'Senior Esthetician',
                'bio' => 'Licensed esthetician with expertise in anti-aging treatments and problematic skin solutions. Advanced certification in medical aesthetics.',
                'profile_image' => 'specialists/sarah-chen.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Maria Rodriguez',
                'title' => 'Nail Art Specialist',
                'bio' => 'Nail art specialist known for intricate designs and long-lasting manicures. Certified in gel and acrylic applications.',
                'profile_image' => 'specialists/maria-rodriguez.jpg',
                'is_active' => true
            ],
            [
                'name' => 'David Kim',
                'title' => 'Massage Therapist',
                'bio' => 'Licensed massage therapist specializing in deep tissue and sports massage. Certified in multiple massage modalities.',
                'profile_image' => 'specialists/david-kim.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Sophie Anderson',
                'title' => 'Makeup Artist',
                'bio' => 'Professional makeup artist with experience in bridal, editorial, and special effects makeup. Trained at Make Up For Ever Academy.',
                'profile_image' => 'specialists/sophie-anderson.jpg',
                'is_active' => true
            ]
        ];

        foreach ($specialists as $specialist) {
            $newSpecialist = Specialist::create([
                'name' => $specialist['name'],
                'slug' => Str::slug($specialist['name']),
                'title' => $specialist['title'],
                'bio' => $specialist['bio'],
                'profile_image' => $specialist['profile_image'],
                'is_active' => $specialist['is_active'],
            ]);
            
            // Assign services to specialists based on their title
            if (str_contains($specialist['title'], 'Hair')) {
                $newSpecialist->services()->attach([1, 2, 3]); // Hair services
            } elseif (str_contains($specialist['title'], 'Esthetician')) {
                $newSpecialist->services()->attach([4, 5]); // Skin services
            } elseif (str_contains($specialist['title'], 'Nail')) {
                $newSpecialist->services()->attach([6, 7]); // Nail services
            } elseif (str_contains($specialist['title'], 'Massage')) {
                $newSpecialist->services()->attach([8, 9]); // Massage services
            } elseif (str_contains($specialist['title'], 'Makeup')) {
                $newSpecialist->services()->attach([10, 11]); // Makeup services
            }

            // Create working hours for each specialist
            for ($day = 0; $day < 7; $day++) {
                if ($day != 0) { // Closed on Sundays
                    WorkingHour::create([
                        'specialist_id' => $newSpecialist->id,
                        'day_of_week' => $day,
                        'start_time' => '09:00:00',
                        'end_time' => '18:00:00',
                        'is_day_off' => false,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        // Create Customers
        $customers = [
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'phone' => '123-555-0001',
                'address' => '123 Main St, Anytown, USA',
                'date_of_birth' => '1990-05-15',
                'gender' => 'female',
                'notes' => 'Prefers natural hair products',
                'is_active' => true,
                'email_notifications' => true,
                'sms_notifications' => true,
                'marketing_emails' => true
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'phone' => '123-555-0002',
                'address' => '456 Oak Ave, Anytown, USA',
                'date_of_birth' => '1985-08-22',
                'gender' => 'male',
                'notes' => 'Allergic to certain hair dyes',
                'is_active' => true,
                'email_notifications' => true,
                'sms_notifications' => false,
                'marketing_emails' => false
            ],
            [
                'name' => 'Carol Davis',
                'email' => 'carol@example.com',
                'phone' => '123-555-0003',
                'address' => '789 Pine St, Anytown, USA',
                'date_of_birth' => '1992-03-10',
                'gender' => 'female',
                'notes' => 'Prefers evening appointments',
                'is_active' => true,
                'email_notifications' => true,
                'sms_notifications' => true,
                'marketing_emails' => true
            ],
            [
                'name' => 'Diana Miller',
                'email' => 'diana@example.com',
                'phone' => '123-555-0004',
                'address' => '321 Elm St, Anytown, USA',
                'date_of_birth' => '1988-11-28',
                'gender' => 'female',
                'notes' => 'Sensitive skin, needs patch test',
                'is_active' => true,
                'email_notifications' => false,
                'sms_notifications' => true,
                'marketing_emails' => false
            ],
            [
                'name' => 'Edward Lee',
                'email' => 'edward@example.com',
                'phone' => '123-555-0005',
                'address' => '654 Maple Dr, Anytown, USA',
                'date_of_birth' => '1983-07-14',
                'gender' => 'male',
                'notes' => 'Prefers male stylists',
                'is_active' => true,
                'email_notifications' => true,
                'sms_notifications' => true,
                'marketing_emails' => true
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Create Appointments and Reviews
        $startDate = Carbon::now()->subMonths(3);
        $endDate = Carbon::now();

        $statuses = ['completed', 'confirmed', 'pending', 'cancelled'];
        $reviews = [
            'Excellent service! Very professional and friendly staff.',
            'Amazing experience! Will definitely come back.',
            'The best salon in town. Highly recommended!',
            'Great attention to detail and wonderful atmosphere.',
            'Amazing atmosphere and service. Worth every penny!'
        ];

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            if ($currentDate->isWeekday()) { // Only create appointments on weekdays
                $numAppointments = rand(3, 8); // Random number of appointments per day
                
                for ($i = 0; $i < $numAppointments; $i++) {
                    $customer = Customer::inRandomOrder()->first();
                    $service = Service::inRandomOrder()->first();
                    $specialist = $service->specialists()->inRandomOrder()->first();
                    
                    if ($specialist) {
                        $status = $currentDate->isPast() ? 'completed' : $statuses[array_rand($statuses)];
                        
                        $booking = Booking::create([
                            'service_id' => $service->id,
                            'specialist_id' => $specialist->id,
                            'start_time' => $currentDate->copy()->setTime(rand(9, 17), 0, 0),
                            'end_time' => $currentDate->copy()->setTime(rand(9, 17), 0, 0)->addMinutes($service->duration),
                            'status' => $status,
                            'confirmation_code' => uniqid('BK-'),
                            'customer_details' => json_encode([
                                'name' => $customer->name,
                                'email' => $customer->email,
                                'phone' => $customer->phone
                            ]),
                            'notes' => rand(0, 1) ? 'Please be gentle' : null,
                            'timezone' => 'UTC',
                            'total_price' => $service->price,
                            'payment_status' => 'pending'
                        ]);

                        // Add review for completed bookings
                        if ($status === 'completed' && rand(0, 1)) {
                            ServiceReview::create([
                                'booking_id' => $booking->id,
                                'rating' => rand(4, 5),
                                'review_text' => $reviews[array_rand($reviews)]
                            ]);
                        }
                    }
                }
            }
            $currentDate->addDay();
        }
    }
}
