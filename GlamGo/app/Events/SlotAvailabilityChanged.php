<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SlotAvailabilityChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private int $serviceId,
        private int $specialistId,
        private Carbon $startTime,
        private Carbon $endTime,
        private bool $isAvailable
    ) {}

    public function broadcastOn(): array
    {
        return [new Channel('bookings')];
    }

    public function broadcastAs(): string
    {
        return 'slot.availability';
    }

    public function broadcastWith(): array
    {
        return [
            'service_id' => $this->serviceId,
            'specialist_id' => $this->specialistId,
            'start_time' => $this->startTime->format('Y-m-d H:i:s'),
            'end_time' => $this->endTime->format('Y-m-d H:i:s'),
            'is_available' => $this->isAvailable
        ];
    }
} 