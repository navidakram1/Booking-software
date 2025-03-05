<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class AppointmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;
    protected $type;

    public function __construct(Booking $appointment, $type = 'status_update')
    {
        $this->appointment = $appointment;
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
                $message->line('Your appointment has been booked successfully.')
                    ->line('Service: ' . $this->appointment->service->name)
                    ->line('Date: ' . $this->appointment->appointment_date->format('l, F j, Y'))
                    ->line('Time: ' . $this->appointment->appointment_date->format('g:i A'))
                    ->line('Staff: ' . $this->appointment->staff->name)
                    ->action('View Appointment', url('/appointments/' . $this->appointment->id))
                    ->line('Thank you for choosing our services!');
                break;

            case 'status_update':
                $message->line('Your appointment status has been updated to ' . $this->appointment->status . '.')
                    ->line('Service: ' . $this->appointment->service->name)
                    ->line('Date: ' . $this->appointment->appointment_date->format('l, F j, Y'))
                    ->line('Time: ' . $this->appointment->appointment_date->format('g:i A'))
                    ->action('View Appointment', url('/appointments/' . $this->appointment->id));
                break;

            case 'reminder':
                $message->line('This is a reminder for your upcoming appointment.')
                    ->line('Service: ' . $this->appointment->service->name)
                    ->line('Date: ' . $this->appointment->appointment_date->format('l, F j, Y'))
                    ->line('Time: ' . $this->appointment->appointment_date->format('g:i A'))
                    ->line('Staff: ' . $this->appointment->staff->name)
                    ->action('View Appointment', url('/appointments/' . $this->appointment->id))
                    ->line('We look forward to seeing you!');
                break;
        }

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->id,
            'type' => $this->type,
            'message' => $this->getNotificationMessage(),
            'status' => $this->appointment->status
        ];
    }

    protected function getEmailSubject()
    {
        switch ($this->type) {
            case 'booking_confirmation':
                return 'Appointment Confirmation - GlamGo';
            case 'status_update':
                return 'Appointment Status Updated - GlamGo';
            case 'reminder':
                return 'Appointment Reminder - GlamGo';
            default:
                return 'Appointment Notification - GlamGo';
        }
    }

    protected function getNotificationMessage()
    {
        switch ($this->type) {
            case 'booking_confirmation':
                return 'Your appointment has been booked successfully.';
            case 'status_update':
                return 'Your appointment status has been updated to ' . $this->appointment->status . '.';
            case 'reminder':
                return 'Reminder: You have an appointment tomorrow.';
            default:
                return 'Your appointment has been updated.';
        }
    }
}
