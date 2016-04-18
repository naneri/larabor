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
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\AddLog::class,
        \App\Console\Commands\ClearTemp::class,
        \App\Console\Commands\UpdateCatStats::class,
        \App\Console\Commands\ArchiveItems::class,
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
        $schedule->command('items:archive')->everyFiveMinutes()->withoutOverlapping();
    }
}
