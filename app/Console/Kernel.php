<?php

namespace App\Console;

use App\Jobs\ProcessNotification;
use App\Contracts\NotificationContract;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use OutOfRangeException;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $this->scheduleNotification($schedule);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function scheduleNotification(Schedule $schedule)
    {
        $t = config('firebase.push_notification.interval_minutes');
        if ($t < 1 || $t > 59) {
            throw new OutOfRangeException("Interval must be in range [1..59]");
        }
        $repo = app(NotificationContract::class);
        $schedule->job(new ProcessNotification($repo))->cron("*/$t * * * *");
    }
}
