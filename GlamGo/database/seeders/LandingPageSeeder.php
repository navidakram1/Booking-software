<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPage;

class LandingPageSeeder extends Seeder
{
    public function run()
    {
        LandingPage::create([
            'hero_title' => 'Welcome to GlamGo',
            'hero_subtitle' => 'Your Premier Beauty Destination',
            'hero_cta_text' => 'Book Now',
            'hero_cta_link' => '/appointments/book',
            'about_title' => 'About GlamGo',
            'about_content' => 'GlamGo is your premier beauty destination, offering a wide range of services from expert stylists and beauty professionals. Our mission is to help you look and feel your best.',
            'features' => [
                [
                    'title' => 'Expert Stylists',
                    'description' => 'Our team of professional stylists are trained in the latest techniques and trends.',
                    'icon' => 'fas fa-cut'
                ],
                [
                    'title' => 'Premium Products',
                    'description' => 'We use only the highest quality products for all our services.',
                    'icon' => 'fas fa-pump-soap'
                ],
                [
                    'title' => 'Modern Facilities',
                    'description' => 'Our salon is equipped with state-of-the-art facilities for your comfort.',
                    'icon' => 'fas fa-building'
                ]
            ],
            'stats' => [
                [
                    'label' => 'Happy Clients',
                    'value' => 5000,
                    'icon' => 'fas fa-smile'
                ],
                [
                    'label' => 'Expert Stylists',
                    'value' => 20,
                    'icon' => 'fas fa-user-tie'
                ],
                [
                    'label' => 'Services Offered',
                    'value' => 50,
                    'icon' => 'fas fa-list'
                ],
                [
                    'label' => 'Years of Experience',
                    'value' => 10,
                    'icon' => 'fas fa-clock'
                ]
            ]
        ]);
    }
}
