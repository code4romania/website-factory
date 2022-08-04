<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetupCommand extends Command
{
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
    public function handle()
    {
        $this->createDefaultLanguages();

        $this->createDefaultPages();

        $this->createDefaultSettings();

        $this->createFirstUser();

        $this->info('Install complete!');

        return self::SUCCESS;
    }

    protected function createDefaultLanguages(): void
    {
        if (Language::count()) {
            $this->warn('The languages table is not empty. Skipping language creation...');

            $this->call(UpdateTranslationsCommand::class, ['--force' => false]);

            return;
        }

        $this->info('Creating default languages...');

        Language::insert([
            [
                'code'    => 'ro',
                'name'    => 'Română',
                'enabled' => true,
            ],
            [
                'code'    => 'en',
                'name'    => 'English',
                'enabled' => false,
            ],
        ]);

        $this->call(UpdateTranslationsCommand::class, ['--force' => true]);
    }

    protected function createDefaultPages(): void
    {
        if (Page::count()) {
            $this->warn('The pages table is not empty. Skipping pages creation...');

            return;
        }

        $this->info('Creating default pages...');

        Page::create([
            'title'        => $this->localized('Home'),
            'description'  => $this->localized(''),
            'published_at' => now(),
        ]);
    }

    protected function createDefaultSettings(): void
    {
        if (Setting::count()) {
            $this->warn('The settings table is not empty. Skipping settings creation...');

            return;
        }

        $this->info('Creating default settings...');

        Setting::insert([
            [
                'section' => 'site',
                'key'     => 'title',
                'value'   => $this->localized(config('app.name'), encoded: true),
            ],
            [
                'section' => 'site',
                'key'     => 'colors',
                'value'   => json_encode([
                    'primary' => '#FFCC00',
                ]),
            ],
            [
                'section' => 'site',
                'key'     => 'front_page',
                'value'   => Page::first()?->id,
            ],
            [
                'section' => 'site-notice',
                'key'     => 'enabled',
                'value'   => false,
            ],
            [
                'section' => 'site-notice',
                'key'     => 'color',
                'value'   => json_encode('#FCB900'),
            ],
            [
                'section' => 'site-notice',
                'key'     => 'text',
                'value'   => $this->localized('', encoded: true),
            ],
        ]);
    }

    protected function createFirstUser(): void
    {
        if (User::count()) {
            $this->warn('The users table is not empty. Skipping user creation...');

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
            'email'    => $email,
            'name'     => 'Administrator',
            'password' => Hash::make($password),
            'role'     => 'admin',
        ]);

        $this->info('Successfully created user for ' . $email);
    }

    private function localized(mixed $value, bool $encoded = false): mixed
    {
        return locales()
            ->mapWithKeys(fn (array $config, string $locale) => [
                $locale => $value,
            ])
            ->when(
                $encoded,
                fn ($collection) => $collection->toJson(),
                fn ($collection) => $collection->toArray()
            );
    }
}
