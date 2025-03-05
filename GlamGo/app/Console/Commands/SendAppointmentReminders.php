<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Notifications\AppointmentNotification;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Send reminders for upcoming appointments';

    public function handle()
    {
        // Get appointments for tomorrow
        $tomorrow = Carbon::tomorrow();
        $appointments = Booking::with(['client', 'staff', 'service'])
            ->whereDate('appointment_date', $tomorrow)
            ->where('status', 'confirmed')
            ->get();

        $this->info("Found {$appointments->count()} appointments for tomorrow.");

        foreach ($appointments as $appointment) {
            try {
                $appointment->client->notify(new AppointmentNotification($appointment, 'reminder'));
                $this->info("Sent reminder for appointment #{$appointment->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for appointment #{$appointment->id}: {$e->getMessage()}");
            }
        }

        $this->info('Finished sending appointment reminders.');
    }
}
