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
        Commands\Inspire::class,
        Commands\AddLog::class,
        Commands\ClearTemp::class,
        Commands\UpdateCatStats::class,
        Commands\ArchiveItems::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('temp:clear')->hourly();
        $schedule->command('cat:update')->hourly();
      //  $schedule->command('items:archive')->everyFiveMinutes()->withoutOverlapping();
    }
}
