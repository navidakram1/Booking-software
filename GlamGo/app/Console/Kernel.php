<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendAppointmentReminders::class,
        Commands\BackupDatabase::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Send appointment reminders daily at 9 AM
        $schedule->command('appointments:send-reminders')
                ->dailyAt('09:00')
                ->timezone('America/New_York');

        // Clean up old notifications weekly
        $schedule->command('notifications:clean')
                ->weekly()
                ->sundays()
                ->at('00:00');

        // Database backup schedule - run daily at midnight
        $schedule->command('db:backup')
                ->dailyAt('00:00')
                ->appendOutputTo(storage_path('logs/db-backups.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
