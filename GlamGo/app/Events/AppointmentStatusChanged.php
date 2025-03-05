<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class AppointmentStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appointment;

    public function __construct(Booking $appointment)
    {
        $this->appointment = $appointment;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('appointments.' . $this->appointment->id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->appointment->id,
            'status' => $this->appointment->status,
            'message' => 'Appointment status has been updated to ' . $this->appointment->status
        ];
    }
}
