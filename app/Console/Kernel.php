<?php

namespace App\Console;

use App\Models\Loker;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            while (true) {
                Loker::where('tanggal_akhir', '<', Carbon::now())
                    ->where('status', 'Dipublikasi')
                    ->update(['status' => 'Tidak Dipublikasi']);
                sleep(1);
            }
        })->everyMinute();
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
