<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HealthCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used for Docker container healthcheck';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (app()->isDownForMaintenance()) {
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
