<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform the initial Website Factory setup';

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

        $this->info('Install complete!');

        return self::SUCCESS;
    }

    protected function createDefaultLanguages(): void
    {
        $this->info('Creating default languages...');

        if (Language::count()) {
            $this->warn('The languages table is not empty. Skipping...');

            return;
        }

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
        $this->info('Creating default pages...');

        if (Page::count()) {
            $this->warn('The pages table is not empty. Skipping...');

            return;
        }

        Page::create([
            'title'        => $this->localized('Home'),
            'description'  => $this->localized(''),
            'published_at' => now(),
        ]);
    }

    protected function createDefaultSettings(): void
    {
        $this->info('Creating default settings...');

        if (Setting::count()) {
            $this->warn('The settings table is not empty. Skipping...');

            return;
        }

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
