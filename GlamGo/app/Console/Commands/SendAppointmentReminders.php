<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Notifications\BookingNotification;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'bookings:send-reminders';
    protected $description = 'Send reminders for upcoming bookings';

    public function handle()
    {
        // Get bookings for tomorrow
        $tomorrow = Carbon::tomorrow();
        $bookings = Booking::with(['user', 'staff', 'service'])
            ->whereDate('start_time', $tomorrow)
            ->where('status', 'confirmed')
            ->get();

        $this->info("Found {$bookings->count()} bookings for tomorrow.");

        foreach ($bookings as $booking) {
            try {
                $booking->user->notify(new BookingNotification($booking, 'reminder'));
                $this->info("Sent reminder for booking #{$booking->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for booking #{$booking->id}: {$e->getMessage()}");
            }
        }

        $this->info('Finished sending booking reminders.');
    }
}
