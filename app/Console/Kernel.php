<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        //only run on production system, not local or allocatedev domain
        if (!app()->environment('production')) 
        {
            return;
        }

        // $schedule->command('inspire')->hourly();
        //$schedule->command('app:test-cron')->everyMinute();
        
        $schedule->command('app:allocate-skills')->dailyAt('23:30')->withoutOverlapping();
        $schedule->command('app:allocate-duty')->dailyAt('23:35')->withoutOverlapping();
        $schedule->command('app:allocate-nationalities')->dailyAt('23:40')->withoutOverlapping();
        $schedule->command('app:allocate-grades')->dailyAt('23:45')->withoutOverlapping();

        $schedule->command('app:nursing-candidates')->hourly()->withoutOverlapping(); //get active/approved candidates from Nursing Breeze and their availability
        $schedule->command('app:nursing-hospitals')->dailyAt('23:47')->withoutOverlapping(); //get any new hospitals from Nursing Breeze

        $schedule->command('app:nursing-candidates-availability')->cron('15,45 * * * *')->withoutOverlapping();
        $schedule->command('app:candidates-cache-availability')->cron('02,17,47 * * * *')->withoutOverlapping(); //02 is for when the app:nursing-candidates completes and 17, 47 after app:nursing-candidates-availability completes
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
}
