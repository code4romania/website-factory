<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use App\Services\SupportsTrait;
use App\Traits\ClearsResponseCache;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Throwable;

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
    public function handle()
    {
        $this->seedLanguages();
        $this->seedSettings();
        $this->seedPages();
        $this->seedAdministrator();

        self::clearResponseCache();

        $this->info('Setup complete!');

        return self::SUCCESS;
    }

    protected function seedLanguages(): void
    {
        $shouldCreateLanguages = Language::count() === 0;

        if ($shouldCreateLanguages) {
            $this->info('Creating default languages...');

            Language::insert([
                [
                    'code' => 'ro',
                    'enabled' => true,
                ],
                [
                    'code' => 'en',
                    'enabled' => false,
                ],
            ]);
        }

        $this->call(UpdateTranslationsCommand::class);
    }

    protected function seedSettings(): void
    {
        if (Setting::count()) {
            return;
        }

        $this->loadData('settings')->each(function (array $attributes) {
            Setting::create($attributes);
        });
    }

    protected function seedPages(): void
    {
        if (Page::count()) {
            return;
        }

        $this->info('Creating default pages...');

        $this->loadData('pages')->each(function (array $attributes) {
            $page = $this->saveModel(Page::class, $attributes);

            $setting = $attributes['_map_to_setting'] ?? [];

            if (\count($setting) === 2) {
                Setting::create([
                    'section' => $setting[0],
                    'key' => $setting[1],
                    'value' => $page->id,
                ]);
            }
        });
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

    private function loadData(string $file): Collection
    {
        $edition = config('website-factory.edition');

        try {
            $content = json_decode(
                File::get(database_path("seeders/data/{$edition}/{$file}.json")),
                true
            );
        } catch (Throwable $th) {
            $content = null;
        }

        return collect($content);
    }

    private function saveModel(string $model, array $attributes): Model
    {
        if (
            \array_key_exists('published_at', $attributes) &&
            $attributes['published_at'] === 'now'
        ) {
            $attributes['published_at'] = now();
        }

        $item = $model::create($attributes);

        if (SupportsTrait::blocks($model)) {
            $item->saveBlocks($attributes['blocks'] ?? []);
        }

        if (SupportsTrait::media($model)) {
            $item->saveMedia($attributes['media'] ?? []);
        }

        return $item;
    }
}
