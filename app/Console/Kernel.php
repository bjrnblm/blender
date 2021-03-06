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
        Commands\ClearBeanstalkdQueue::class,
        Commands\CreateUser::class,
        Commands\DeleteOldDrafts::class,
        Commands\GenerateModule::class,
        Commands\PerformScheduledBackup::class,
        Commands\SendSlackMessage::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:scheduled')->dailyAt('03:00');
        $schedule->command('db:deleteOldDrafts')->sundays();
    }
}
