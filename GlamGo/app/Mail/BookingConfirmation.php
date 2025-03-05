<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Booking $booking
    ) {}

    public function build(): self
    {
        $viewUrl = URL::signedRoute('bookings.show', ['booking' => $this->booking]);
        $calendarInvite = $this->generateCalendarInvite();

        return $this->subject('Booking Confirmation - ' . $this->booking->confirmation_code)
            ->markdown('emails.bookings.confirmation', [
                'booking' => $this->booking,
                'viewUrl' => $viewUrl
            ])
            ->attachData(
                $calendarInvite,
                'appointment.ics',
                ['mime' => 'text/calendar; charset=UTF-8; method=REQUEST']
            );
    }

    private function generateCalendarInvite(): string
    {
        $booking = $this->booking;
        $service = $booking->service;
        $specialist = $booking->specialist;

        $template = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//GlamGo//Booking System//EN',
            'METHOD:REQUEST',
            'BEGIN:VEVENT',
            'UID:' . $booking->confirmation_code,
            'SUMMARY:' . $service->name . ' with ' . $specialist->name,
            'DTSTART:' . $booking->start_time->format('Ymd\THis'),
            'DTEND:' . $booking->end_time->format('Ymd\THis'),
            'DTSTAMP:' . now()->format('Ymd\THis'),
            'LOCATION:' . config('app.salon_address'),
            'DESCRIPTION:' . $this->getEventDescription(),
            'STATUS:CONFIRMED',
            'SEQUENCE:0',
            'BEGIN:VALARM',
            'TRIGGER:-PT1H',
            'ACTION:DISPLAY',
            'DESCRIPTION:Reminder: ' . $service->name . ' appointment in 1 hour',
            'END:VALARM',
            'END:VEVENT',
            'END:VCALENDAR'
        ];

        return implode("\r\n", $template);
    }

    private function getEventDescription(): string
    {
        $booking = $this->booking;
        $service = $booking->service;

        return implode('\n', [
            'Service: ' . $service->name,
            'Duration: ' . $service->duration . ' minutes',
            'Price: $' . number_format($booking->total_price, 2),
            'Specialist: ' . $booking->specialist->name,
            'Confirmation Code: ' . $booking->confirmation_code,
            'Notes: ' . ($booking->notes ?? 'None'),
            '\n',
            'Please arrive 10 minutes before your appointment time.',
            'For cancellations, please contact us at least 24 hours in advance.'
        ]);
    }
}
