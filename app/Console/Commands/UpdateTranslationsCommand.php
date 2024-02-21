<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Language;
use App\Models\LanguageLine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Throwable;

class UpdateTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:translations
        {--force : Remove all translations and perform a full import }
        {--reset : Replace existing translations without affecting translations for languages not present in the `lang` dir }
        {--locale=* : Locale to load}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update database translations with missing keys from the `lang` dir';

    /**
     * Translations key/value list.
     *
     * @var array
     */
    protected array $lines = [];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->collect();

        LanguageLine::withoutEvents(function () {
            if ($this->option('force')) {
                $this->forceUpdate();
            } elseif ($this->option('reset')) {
                $this->updateEverything();
            } else {
                $this->updateMissing();
            }
        });

        Cache::flush();

        return self::SUCCESS;
    }

    protected function collect(): void
    {
        $locales = collect($this->option('locale'));

        Language::all()
            ->filter(function (Language $language) use ($locales) {
                return $locales->isEmpty() || $locales->contains($language->code);
            })
            ->each(function (Language $language) {
                $file = lang_path($language->code . '.json');

                if (! file_exists($file)) {
                    return;
                }

                try {
                    $lines = json_decode(
                        File::get($file),
                        associative: true,
                        flags: \JSON_THROW_ON_ERROR
                    );
                } catch (Throwable $th) {
                    $this->warn("Could not fetch the contents of {$file}. Skipping...");
                    $lines = [];
                }

                collect($lines)
                    ->each(function ($line, $key) use ($language) {
                        $this->lines[$key][$language->code] = $line;
                    });

                $this->info("[$language->code] Fetched " . \count($lines) . ' translations.');
            });
    }

    protected function forceUpdate(): void
    {
        LanguageLine::truncate();

        LanguageLine::insert(
            collect($this->lines)
                ->map(fn (array $text, string $key) => [
                    'group' => '*',
                    'key' => $key,
                    'text' => collect($text)
                        ->sortKeys()
                        ->toJson(),
                ])
                ->all()
        );

        $this->info('Replaced all database translations.');
    }

    protected function updateEverything(): void
    {
        $existingLines = LanguageLine::query()
            ->where('group', '*')
            ->get();

        $newLines = collect($this->lines)
            ->map(fn (array $text, string $key) => [
                'group' => '*',
                'key' => $key,
                'text' => collect(
                    $existingLines
                        ->firstWhere('key', $key)
                        ?->text ?: []
                )
                    ->merge($text)
                    ->sortKeys()
                    ->toJson(),
            ])
            ->values();

        LanguageLine::upsert($newLines->all(), ['group', 'key'], ['text']);

        $this->info('Updated database translations.');
    }

    protected function updateMissing(): void
    {
        $existingLines = LanguageLine::query()
            ->where('group', '*')
            ->get();

        $newLines = collect($this->lines)
            ->map(fn (array $text, string $key) => [
                'group' => '*',
                'key' => $key,
                'text' => collect($text)
                    ->merge(
                        $existingLines
                            ->firstWhere('key', $key)
                            ?->text ?: []
                    )
                    ->sortKeys()
                    ->toJson(),
            ])
            ->values();

        LanguageLine::upsert($newLines->all(), ['group', 'key'], ['text']);

        $this->info('Added missing database translations.');
    }
}
