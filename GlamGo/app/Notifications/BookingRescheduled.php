<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingRescheduled extends Notification implements ShouldQueue
{
    use Queueable;

    protected $oldBooking;
    protected $newBooking;

    public function __construct(Booking $oldBooking, Booking $newBooking)
    {
        $this->oldBooking = $oldBooking;
        $this->newBooking = $newBooking;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Booking Rescheduled - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your booking has been rescheduled.')
            ->line('Service: ' . $this->newBooking->service->name)
            ->line('Previous Date: ' . $this->oldBooking->formatted_start_time)
            ->line('New Date: ' . $this->newBooking->formatted_start_time)
            ->line('Staff Member: ' . $this->newBooking->staff->name)
            ->action('View Booking Details', url('/bookings/' . $this->newBooking->id))
            ->line('If this time does not work for you, please contact us to reschedule.')
            ->line('Thank you for your understanding!');
    }

    public function toArray($notifiable): array
    {
        return [
            'old_booking_id' => $this->oldBooking->id,
            'new_booking_id' => $this->newBooking->id,
            'service' => $this->newBooking->service->name,
            'old_date' => $this->oldBooking->formatted_start_time,
            'new_date' => $this->newBooking->formatted_start_time,
            'staff' => $this->newBooking->staff->name
        ];
    }
} 