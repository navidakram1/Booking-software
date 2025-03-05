<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $type;

    public function __construct(Booking $booking, $type = 'status_update')
    {
        $this->booking = $booking;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject($this->getEmailSubject())
            ->greeting('Hello ' . $notifiable->name . '!');

        switch ($this->type) {
            case 'booking_confirmation':
                $message->line('Your booking has been confirmed successfully.')
                    ->line('Service: ' . $this->booking->service->name)
                    ->line('Date: ' . $this->booking->start_time->format('l, F j, Y'))
                    ->line('Time: ' . $this->booking->start_time->format('g:i A'))
                    ->line('Staff: ' . $this->booking->staff->name)
                    ->action('View Booking', url('/bookings/' . $this->booking->id))
                    ->line('Thank you for choosing our services!');
                break;

            case 'status_update':
                $message->line('Your booking status has been updated to ' . $this->booking->status . '.')
                    ->line('Service: ' . $this->booking->service->name)
                    ->line('Date: ' . $this->booking->start_time->format('l, F j, Y'))
                    ->line('Time: ' . $this->booking->start_time->format('g:i A'))
                    ->action('View Booking', url('/bookings/' . $this->booking->id));
                break;

            case 'reminder':
                $message->line('This is a reminder for your upcoming booking.')
                    ->line('Service: ' . $this->booking->service->name)
                    ->line('Date: ' . $this->booking->start_time->format('l, F j, Y'))
                    ->line('Time: ' . $this->booking->start_time->format('g:i A'))
                    ->line('Staff: ' . $this->booking->staff->name)
                    ->action('View Booking', url('/bookings/' . $this->booking->id))
                    ->line('We look forward to seeing you!');
                break;
        }

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'type' => $this->type,
            'message' => $this->getNotificationMessage(),
            'status' => $this->booking->status
        ];
    }

    protected function getEmailSubject()
    {
        switch ($this->type) {
            case 'booking_confirmation':
                return 'Booking Confirmation - GlamGo';
            case 'status_update':
                return 'Booking Status Updated - GlamGo';
            case 'reminder':
                return 'Booking Reminder - GlamGo';
            default:
                return 'Booking Notification - GlamGo';
        }
    }

    protected function getNotificationMessage()
    {
        switch ($this->type) {
            case 'booking_confirmation':
                return 'Your booking has been confirmed successfully.';
            case 'status_update':
                return 'Your booking status has been updated to ' . $this->booking->status . '.';
            case 'reminder':
                return 'Reminder: You have a booking tomorrow.';
            default:
                return 'Your booking has been updated.';
        }
    }
}
