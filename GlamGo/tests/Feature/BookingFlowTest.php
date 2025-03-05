<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Service;
use App\Models\ServiceAddon;
use App\Models\Specialist;
use App\Models\StaffSchedule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingFlowTest extends TestCase
{
    use RefreshDatabase;

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
            'name' => 'Test Specialist'
        ]);

        $this->addon = ServiceAddon::factory()->create([
            'service_id' => $this->service->id,
            'name' => 'Test Addon',
            'duration' => 30,
            'price' => 50.00
        ]);

        // Create working hours for the specialist
        StaffSchedule::create([
            'specialist_id' => $this->specialist->id,
            'day_of_week' => Carbon::now()->addDay()->format('l'),
            'start_time' => '09:00',
            'end_time' => '17:00',
            'is_working_day' => true
        ]);
    }

    public function test_complete_booking_flow()
    {
        // Step 1: Get available services
        $response = $this->getJson('/api/services');
        $response->assertStatus(200)
                ->assertJsonStructure([
                    '*' => ['id', 'name', 'duration', 'price']
                ]);

        // Step 2: Get specialists for service
        $response = $this->getJson("/api/specialists?service_id={$this->service->id}");
        $response->assertStatus(200)
                ->assertJsonStructure([
                    '*' => ['id', 'name', 'title']
                ]);

        // Step 3: Get available time slots
        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');
        $response = $this->getJson("/api/available-slots?" . http_build_query([
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'date' => $tomorrow
        ]));
        $response->assertStatus(200)
                ->assertJsonStructure([
                    '*' => ['start_time', 'end_time']
                ]);

        $slot = $response->json()[0];

        // Step 4: Create booking
        $response = $this->postJson('/api/bookings', [
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'start_time' => $slot['start_time'],
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890'
            ],
            'addons' => [$this->addon->id],
            'timezone' => 'UTC'
        ]);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'id',
                    'confirmation_code',
                    'start_time',
                    'end_time',
                    'total_price'
                ]);

        // Verify booking details in database
        $this->assertDatabaseHas('bookings', [
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'status' => 'pending'
        ]);

        // Verify addon was attached
        $this->assertDatabaseHas('booking_addons', [
            'booking_id' => $response->json('id'),
            'service_addon_id' => $this->addon->id
        ]);
    }

    public function test_booking_validation()
    {
        $response = $this->postJson('/api/bookings', [
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'start_time' => null,
            'customer_details' => [
                'first_name' => '',
                'email' => 'invalid-email'
            ]
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors([
                    'start_time',
                    'customer_details.first_name',
                    'customer_details.last_name',
                    'customer_details.email',
                    'customer_details.phone'
                ]);
    }

    public function test_cannot_double_book_slot()
    {
        // Create initial booking
        $startTime = Carbon::now()->addDay()->setHour(10)->setMinute(0);
        $booking = $this->postJson('/api/bookings', [
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'start_time' => $startTime,
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890'
            ],
            'timezone' => 'UTC'
        ]);

        $booking->assertStatus(201);

        // Try to book the same slot
        $response = $this->postJson('/api/bookings', [
            'service_id' => $this->service->id,
            'specialist_id' => $this->specialist->id,
            'start_time' => $startTime,
            'customer_details' => [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'phone' => '0987654321'
            ],
            'timezone' => 'UTC'
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['start_time']);
    }
} 