namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmation extends Notification implements ShouldQueue
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
            ->subject('Booking Confirmation - GlamGo')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your booking has been confirmed.')
            ->line('Service: ' . $this->booking->service->name)
            ->line('Specialist: ' . $this->booking->specialist->name)
            ->line('Date & Time: ' . $startTime)
            ->line('Duration: ' . $this->booking->service->duration . ' minutes')
            ->line('Total Amount: $' . number_format($this->booking->amount_paid, 2))
            ->action('View Booking Details', url('/bookings/' . $this->booking->id))
            ->line('Thank you for choosing GlamGo!')
            ->line('If you need to modify or cancel your booking, please do so at least 24 hours before your appointment.');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'message' => 'Your booking for ' . $this->booking->service->name . ' has been confirmed.',
            'type' => 'booking_confirmation',
            'start_time' => $this->booking->start_time->toIso8601String()
        ];
    }
} 