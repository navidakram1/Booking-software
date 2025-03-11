<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(Booking $booking, string $oldStatus, string $newStatus)
    {
        $this->booking = $booking;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Booking Status Updated - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your booking status has been updated.')
            ->line('Service: ' . $this->booking->service->name)
            ->line('Date: ' . $this->booking->formatted_start_time)
            ->line('Previous Status: ' . Booking::getStatuses()[$this->oldStatus])
            ->line('New Status: ' . Booking::getStatuses()[$this->newStatus]);

        if ($this->booking->cancellation_reason) {
            $message->line('Reason: ' . $this->booking->cancellation_reason);
        }

        $message->action('View Booking Details', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our service!');

        return $message;
    }

    public function toArray($notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'service' => $this->booking->service->name,
            'date' => $this->booking->formatted_start_time,
            'reason' => $this->booking->cancellation_reason
        ];
    }
} 