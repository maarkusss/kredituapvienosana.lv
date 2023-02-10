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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('statistics:update')->hourly();
        $schedule->command('commissions:import')
            ->hourly();
        $schedule->command('epc:update')
            ->everyTenMinutes();
        $schedule->command('sorting:update')
            ->hourly();
        $schedule->command('csv:create')
            ->hourly();
        $schedule->command('sitemap:generate')
            ->daily();
        // $schedule->command('consumers:update')
        //     ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
