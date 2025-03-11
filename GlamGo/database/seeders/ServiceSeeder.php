<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ServiceAddon;
use App\Models\SpecialOffer;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Get existing categories
        $hairCategory = ServiceCategory::where('name', 'Hair Styling')->first();
        $nailCategory = ServiceCategory::where('name', 'Manicure')->first();
        $facialCategory = ServiceCategory::where('name', 'Hair Coloring')->first();
        $massageCategory = ServiceCategory::where('name', 'Pedicure')->first();

        if (!$hairCategory || !$nailCategory || !$facialCategory || !$massageCategory) {
            throw new \Exception('Required service categories not found. Please ensure ServiceCategorySeeder has been run.');
        }

        $services = [
            [
                'category_id' => $hairCategory->id,
                'name' => 'Haircut & Style',
                'slug' => 'haircut-and-style',
                'description' => 'Professional haircut and styling',
                'duration' => 60,
                'price' => 65.00,
                'is_active' => true
            ],
            [
                'category_id' => $hairCategory->id,
                'name' => 'Hair Coloring',
                'slug' => 'hair-coloring',
                'description' => 'Full hair coloring service',
                'duration' => 120,
                'price' => 120.00,
                'is_active' => true
            ],
            [
                'category_id' => $nailCategory->id,
                'name' => 'Manicure',
                'slug' => 'manicure',
                'description' => 'Classic manicure service',
                'duration' => 45,
                'price' => 35.00,
                'is_active' => true
            ],
            [
                'category_id' => $nailCategory->id,
                'name' => 'Pedicure',
                'slug' => 'pedicure',
                'description' => 'Classic pedicure service',
                'duration' => 60,
                'price' => 45.00,
                'is_active' => true
            ],
            [
                'category_id' => $facialCategory->id,
                'name' => 'Classic Facial',
                'slug' => 'classic-facial',
                'description' => 'Deep cleansing facial treatment',
                'duration' => 60,
                'price' => 75.00,
                'is_active' => true
            ],
            [
                'category_id' => $massageCategory->id,
                'name' => 'Swedish Massage',
                'slug' => 'swedish-massage',
                'description' => 'Relaxing full body massage',
                'duration' => 60,
                'price' => 85.00,
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Create Addons
        $haircut = Service::where('slug', 'haircut-and-style')->first();
        $manicure = Service::where('slug', 'manicure')->first();
        $facial = Service::where('slug', 'classic-facial')->first();

        $addons = [
            [
                'service_id' => $haircut->id,
                'name' => 'Deep Conditioning',
                'description' => 'Intensive hair treatment',
                'price' => 25.00,
                'duration' => 15,
                'is_active' => true
            ],
            [
                'service_id' => $manicure->id,
                'name' => 'Gel Polish',
                'description' => 'Long-lasting gel polish',
                'price' => 15.00,
                'duration' => 15,
                'is_active' => true
            ],
            [
                'service_id' => $facial->id,
                'name' => 'Eye Treatment',
                'description' => 'Special eye area treatment',
                'price' => 20.00,
                'duration' => 15,
                'is_active' => true
            ]
        ];

        foreach ($addons as $addon) {
            ServiceAddon::create($addon);
        }

        // Create Special Offers
        $specialOffers = [
            [
                'service_id' => $haircut->id,
                'name' => 'New Client Special',
                'description' => 'Special discount for first-time clients',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(1),
                'is_active' => true,
                'code' => 'NEWCLIENT20'
            ],
            [
                'service_id' => $manicure->id,
                'name' => 'Spring Special',
                'description' => 'Special spring discount',
                'discount_type' => 'fixed',
                'discount_value' => 10,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'is_active' => true,
                'code' => 'SPRING10'
            ]
        ];

        foreach ($specialOffers as $offer) {
            SpecialOffer::create($offer);
        }
    }
}

