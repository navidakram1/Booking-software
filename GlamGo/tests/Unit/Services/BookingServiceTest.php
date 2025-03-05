<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Booking;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;

    private BookingService $bookingService;
    private Service $service;
    private Specialist $specialist;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->bookingService = new BookingService();
        
        // Create test data
        $this->service = Service::factory()->create([
            'duration' => 60,
            'price' => 100.00
        ]);
        
        $this->specialist = Specialist::factory()->create();
    }

    public function test_can_check_slot_availability()
    {
        $startTime = Carbon::now()->addDay()->setHour(10)->setMinute(0);
        $endTime = $startTime->copy()->addHour();

        // Should be available as no bookings exist
        $isAvailable = $this->bookingService->isSlotAvailable(
            $this->specialist->id,
            $startTime,
            $endTime
        );
        
        $this->assertTrue($isAvailable);

        // Create a booking
        Booking::factory()->create([
            'specialist_id' => $this->specialist->id,
            'start_time' => $startTime,
            'end_time' => $endTime
        ]);

        // Should not be available now
        $isAvailable = $this->bookingService->isSlotAvailable(
            $this->specialist->id,
            $startTime,
            $endTime
        );
        
        $this->assertFalse($isAvailable);
    }

    public function test_can_calculate_total_duration_with_addons()
    {
        $addons = [
            ['duration' => 30],
            ['duration' => 15]
        ];

        $totalDuration = $this->bookingService->calculateTotalDuration(
            $this->service->duration,
            $addons
        );

        $this->assertEquals(105, $totalDuration); // 60 + 30 + 15
    }

    public function test_can_calculate_total_price_with_addons()
    {
        $addons = [
            ['price' => 50.00],
            ['price' => 25.00]
        ];

        $totalPrice = $this->bookingService->calculateTotalPrice(
            $this->service->price,
            $addons
        );

        $this->assertEquals(175.00, $totalPrice); // 100 + 50 + 25
    }

    public function test_can_generate_time_slots()
    {
        $date = Carbon::now()->addDay();
        $workingHours = [
            'start_time' => '09:00',
            'end_time' => '17:00',
            'break_start' => '12:00',
            'break_end' => '13:00'
        ];

        $slots = $this->bookingService->generateTimeSlots(
            $date,
            $workingHours,
            $this->service->duration
        );

        // Should generate 7 slots (9-12 and 13-17, 1 hour each)
        $this->assertCount(7, $slots);
        
        // First slot should be at 9 AM
        $this->assertEquals(
            '09:00',
            Carbon::parse($slots[0]['start_time'])->format('H:i')
        );
        
        // Last slot should be at 16:00 (for a 1-hour service)
        $this->assertEquals(
            '16:00',
            Carbon::parse($slots[count($slots)-1]['start_time'])->format('H:i')
        );
    }
} 