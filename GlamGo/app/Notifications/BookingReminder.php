namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $startTime = $this->booking->start_time->format('l, F j, Y \a\t g:i A');
        
        return (new MailMessage)
            ->subject('Reminder: Your GlamGo Appointment Tomorrow')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('This is a reminder about your upcoming appointment.')
            ->line('Service: ' . $this->booking->service->name)
            ->line('Specialist: ' . $this->booking->specialist->name)
            ->line('Date & Time: ' . $startTime)
            ->line('Location: ' . config('app.name') . ' Beauty Salon')
            ->action('View Booking Details', url('/bookings/' . $this->booking->id))
            ->line('Please arrive 10 minutes before your appointment time.')
            ->line('If you need to cancel or reschedule, please do so at least 24 hours before your appointment.');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'message' => 'Reminder: Your appointment for ' . $this->booking->service->name . ' is tomorrow.',
            'type' => 'booking_reminder',
            'start_time' => $this->booking->start_time->toIso8601String()
        ];
    }
} 