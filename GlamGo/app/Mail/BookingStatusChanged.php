<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $message;

    public function __construct(Booking $booking, string $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Booking Status Update - ' . $this->booking->confirmation_code)
                    ->markdown('emails.bookings.status-changed');
    }
} 