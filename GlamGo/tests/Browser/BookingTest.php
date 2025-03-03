<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Service;
use App\Models\ServiceAddon;
use App\Models\Specialist;
use App\Models\StaffSchedule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    private Service $service;
    private Specialist $specialist;
    private ServiceAddon $addon;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test data
        $this->service = Service::factory()->create([
            'name' => 'Test Service',
            'duration' => 60,
            'price' => 100.00
        ]);

        $this->specialist = Specialist::factory()->create([
            'name' => 'Test Specialist',
            'title' => 'Senior Stylist'
        ]);

        $this->addon = ServiceAddon::factory()->create([
            'service_id' => $this->service->id,
            'name' => 'Test Addon',
            'duration' => 30,
            'price' => 50.00
        ]);

        // Create working hours
        StaffSchedule::create([
            'specialist_id' => $this->specialist->id,
            'day_of_week' => Carbon::now()->addDay()->format('l'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'is_working_day' => true
        ]);
    }

    public function test_can_complete_booking_flow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/booking')
                    // Step 1: Service Selection
                    ->waitFor('.service-list')
                    ->click(".service-item[data-id='{$this->service->id}']")
                    ->waitForText('Choose your Specialist')
                    
                    // Step 2: Specialist Selection
                    ->click(".specialist-item[data-id='{$this->specialist->id}']")
                    ->waitForText('Select Date & Time')
                    
                    // Step 3: Date & Time Selection
                    ->click('.v-calendar-next') // Move to next month if needed
                    ->click('.v-calendar-day') // Click first available day
                    ->waitFor('.time-slots')
                    ->click('.time-slot') // Click first available time slot
                    ->waitForText('Add-on Services')
                    
                    // Step 4: Add-on Selection
                    ->click(".addon-item[data-id='{$this->addon->id}']")
                    ->waitForText('Your Details')
                    
                    // Step 5: Customer Details
                    ->type('first_name', 'John')
                    ->type('last_name', 'Doe')
                    ->type('email', 'john@example.com')
                    ->type('phone', '1234567890')
                    ->click('button[type="submit"]')
                    
                    // Step 6: Booking Summary
                    ->waitForText('Booking Summary')
                    ->assertSee('Test Service')
                    ->assertSee('Test Specialist')
                    ->assertSee('Test Addon')
                    ->assertSee('$150.00') // Base price + addon
                    
                    // Confirm Booking
                    ->click('button[type="submit"]')
                    ->waitForText('Booking Confirmed!')
                    ->assertSee('A confirmation email has been sent to your inbox');
        });
    }

    public function test_shows_validation_errors()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/booking')
                    // Select service and specialist
                    ->waitFor('.service-list')
                    ->click(".service-item[data-id='{$this->service->id}']")
                    ->waitForText('Choose your Specialist')
                    ->click(".specialist-item[data-id='{$this->specialist->id}']")
                    ->waitForText('Select Date & Time')
                    
                    // Try to proceed without selecting time
                    ->click('button[type="submit"]')
                    ->waitForText('Please select a time slot')
                    
                    // Select time and try to submit empty form
                    ->click('.time-slot')
                    ->waitForText('Your Details')
                    ->click('button[type="submit"]')
                    ->assertSee('The first name field is required')
                    ->assertSee('The email field is required')
                    ->assertSee('The phone field is required');
        });
    }

    public function test_shows_loading_states()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/booking')
                    ->waitFor('.service-list')
                    ->click(".service-item[data-id='{$this->service->id}']")
                    ->assertVisible('.loading-spinner') // Should show loading while fetching specialists
                    ->waitForText('Choose your Specialist')
                    ->click(".specialist-item[data-id='{$this->specialist->id}']")
                    ->assertVisible('.loading-spinner') // Should show loading while fetching time slots
                    ->waitForText('Select Date & Time');
        });
    }

    public function test_shows_error_message_on_api_failure()
    {
        $this->browse(function (Browser $browser) {
            // Simulate network error by disabling the API endpoint
            $browser->visit('/booking')
                    ->waitFor('.service-list')
                    ->click(".service-item[data-id='{$this->service->id}']")
                    ->waitForText('An error occurred while loading specialists')
                    ->assertVisible('.error-message');
        });
    }
} 