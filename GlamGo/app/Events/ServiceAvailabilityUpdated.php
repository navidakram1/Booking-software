<?php

namespace App\Events;

use App\Models\Service;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceAvailabilityUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $service;
    public $availability;

    public function __construct(Service $service, array $availability)
    {
        $this->service = $service;
        $this->availability = $availability;
    }

    public function broadcastOn()
    {
        return new Channel('service-availability');
    }

    public function broadcastAs()
    {
        return 'availability-updated';
    }

    public function broadcastWith()
    {
        return [
            'service_id' => $this->service->id,
            'is_available' => $this->availability['is_available'],
            'next_available_slot' => $this->availability['next_available_slot'],
            'available_slots' => $this->availability['available_slots'] ?? []
        ];
    }
} 