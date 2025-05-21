<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SetupCommand extends Command
{
    use ClearsResponseCache;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform the Website Factory setup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->loadSql();

        $this->seedAdministrator();

        $this->call(UpdateTranslationsCommand::class);

        self::clearResponseCache();

        $this->info('Setup complete!');

        return self::SUCCESS;
    }

    protected function seedAdministrator(): void
    {
        if (User::count()) {
            return;
        }

        if (null === ($email = env('ADMIN_EMAIL'))) {
            $this->error('ADMIN_EMAIL is null. Cannot create user.');

            return;
        }

        if (null === ($password = env('ADMIN_PASSWORD'))) {
            $this->error('ADMIN_PASSWORD is null. Cannot create user.');

            return;
        }

        User::create([
            'email' => $email,
            'name' => 'Administrator',
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Successfully created administrator for ' . $email);
    }

    public function loadSql(): void
    {
        if (Setting::count()) {
            return;
        }

        $edition = config('website-factory.edition');
        $seedFile = database_path("seeders/data/{$edition}.sql");

        if (! File::exists($seedFile)) {
            $this->warn("Seed file for edition '{$edition}' not found. Skipping...");

            return;
        }

        $this->info("Found seed file for edition '{$edition}'. Loading data...");

        DB::unprepared(File::get($seedFile));

        $this->info('Seed complete...');
    }
}
