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
                'image_url' => 'categories/hair-care.jpg'
            ],
            [
                'name' => 'Skin Care',
                'description' => 'Facial treatments, skin analysis, and personalized skin care routines',
                'image_url' => 'categories/skin-care.jpg'
            ],
            [
                'name' => 'Nail Care',
                'description' => 'Professional nail services including manicures, pedicures, and nail art',
                'image_url' => 'categories/nail-care.jpg'
            ],
            [
                'name' => 'Massage',
                'description' => 'Relaxing massage treatments for stress relief and muscle tension',
                'image_url' => 'categories/massage.jpg'
            ],
            [
                'name' => 'Makeup',
                'description' => 'Professional makeup services for all occasions',
                'image_url' => 'categories/makeup.jpg'
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
                'image_url' => 'services/haircut.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Hair Coloring',
                'description' => 'Full hair coloring service with premium products',
                'duration' => 120,
                'price' => 100.00,
                'image_url' => 'services/hair-coloring.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Hair Treatment',
                'description' => 'Deep conditioning and repair treatment for damaged hair',
                'duration' => 45,
                'price' => 75.00,
                'image_url' => 'services/hair-treatment.jpg',
                'is_active' => true
            ],
            // Skin Care Services
            [
                'category_id' => 2,
                'name' => 'Classic Facial',
                'description' => 'Deep cleansing facial with steam and extraction',
                'duration' => 60,
                'price' => 75.00,
                'image_url' => 'services/facial.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Anti-Aging Treatment',
                'description' => 'Advanced anti-aging facial with premium products',
                'duration' => 75,
                'price' => 120.00,
                'image_url' => 'services/anti-aging.jpg',
                'is_active' => true
            ],
            // Nail Care Services
            [
                'category_id' => 3,
                'name' => 'Classic Manicure',
                'description' => 'Professional nail care service with regular polish',
                'duration' => 45,
                'price' => 35.00,
                'image_url' => 'services/manicure.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Gel Pedicure',
                'description' => 'Long-lasting gel polish pedicure with foot massage',
                'duration' => 60,
                'price' => 55.00,
                'image_url' => 'services/pedicure.jpg',
                'is_active' => true
            ],
            // Massage Services
            [
                'category_id' => 4,
                'name' => 'Swedish Massage',
                'description' => 'Relaxing full body massage with medium pressure',
                'duration' => 60,
                'price' => 80.00,
                'image_url' => 'services/swedish-massage.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Deep Tissue Massage',
                'description' => 'Therapeutic massage focusing on muscle tension',
                'duration' => 60,
                'price' => 90.00,
                'image_url' => 'services/deep-tissue.jpg',
                'is_active' => true
            ],
            // Makeup Services
            [
                'category_id' => 5,
                'name' => 'Bridal Makeup',
                'description' => 'Complete bridal makeup with trial session',
                'duration' => 90,
                'price' => 150.00,
                'image_url' => 'services/bridal-makeup.jpg',
                'is_active' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Evening Makeup',
                'description' => 'Glamorous evening makeup for special occasions',
                'duration' => 60,
                'price' => 85.00,
                'image_url' => 'services/evening-makeup.jpg',
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create Specialists
        $specialists = [
            [
                'name' => 'Emily Johnson',
                'email' => 'emily.johnson@glamgo.com',
                'phone' => '123-456-7890',
                'bio' => 'Master hair stylist with over 12 years of experience specializing in color transformations and modern cutting techniques. Certified in advanced coloring techniques from Vidal Sassoon.',
                'profile_image' => 'specialists/emily-johnson.jpg',
                'specialization' => 'Hair Styling, Coloring, Treatments',
                'years_of_experience' => 12,
                'is_active' => true
            ],
            [
                'name' => 'Sarah Chen',
                'email' => 'sarah.chen@glamgo.com',
                'phone' => '123-456-7891',
                'bio' => 'Licensed esthetician with expertise in anti-aging treatments and problematic skin solutions. Advanced certification in medical aesthetics.',
                'profile_image' => 'specialists/sarah-chen.jpg',
                'specialization' => 'Facial Treatments, Skin Care, Anti-Aging',
                'years_of_experience' => 8,
                'is_active' => true
            ],
            [
                'name' => 'Maria Rodriguez',
                'email' => 'maria.rodriguez@glamgo.com',
                'phone' => '123-456-7892',
                'bio' => 'Nail art specialist known for intricate designs and long-lasting manicures. Certified in gel and acrylic applications.',
                'profile_image' => 'specialists/maria-rodriguez.jpg',
                'specialization' => 'Manicure, Pedicure, Nail Art',
                'years_of_experience' => 6,
                'is_active' => true
            ],
            [
                'name' => 'David Kim',
                'email' => 'david.kim@glamgo.com',
                'phone' => '123-456-7893',
                'bio' => 'Licensed massage therapist specializing in deep tissue and sports massage. Certified in multiple massage modalities.',
                'profile_image' => 'specialists/david-kim.jpg',
                'specialization' => 'Swedish Massage, Deep Tissue, Sports Massage',
                'years_of_experience' => 10,
                'is_active' => true
            ],
            [
                'name' => 'Sophie Anderson',
                'email' => 'sophie.anderson@glamgo.com',
                'phone' => '123-456-7894',
                'bio' => 'Professional makeup artist with experience in bridal, editorial, and special effects makeup. Trained at Make Up For Ever Academy.',
                'profile_image' => 'specialists/sophie-anderson.jpg',
                'specialization' => 'Bridal Makeup, Special Occasion Makeup',
                'years_of_experience' => 7,
                'is_active' => true
            ]
        ];

        foreach ($specialists as $specialist) {
            $newSpecialist = Specialist::create($specialist);
            
            // Assign services to specialists based on their specialization
            if (str_contains($specialist['specialization'], 'Hair')) {
                $newSpecialist->services()->attach([1, 2, 3]); // Hair services
            } elseif (str_contains($specialist['specialization'], 'Facial')) {
                $newSpecialist->services()->attach([4, 5]); // Skin services
            } elseif (str_contains($specialist['specialization'], 'Manicure')) {
                $newSpecialist->services()->attach([6, 7]); // Nail services
            } elseif (str_contains($specialist['specialization'], 'Massage')) {
                $newSpecialist->services()->attach([8, 9]); // Massage services
            } elseif (str_contains($specialist['specialization'], 'Makeup')) {
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
                        
                        $appointment = Appointment::create([
                            'customer_id' => $customer->id,
                            'service_id' => $service->id,
                            'specialist_id' => $specialist->id,
                            'appointment_date' => $currentDate->format('Y-m-d'),
                            'appointment_time' => sprintf('%02d:00:00', rand(9, 17)),
                            'status' => $status,
                            'special_requests' => rand(0, 1) ? 'Please be gentle' : null,
                            'total_amount' => $service->price
                        ]);

                        // Add review for completed appointments
                        if ($status === 'completed' && rand(0, 1)) {
                            ServiceReview::create([
                                'appointment_id' => $appointment->id,
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
