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
        {--force : Remove existing translations before running}
        {--locale=* : Locale to load}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database translations with the json files in the `lang` dir';

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

        LanguageLine::withoutEvents(
            fn () => $this->option('force')
                ? $this->updateEverything()
                : $this->updateMissing()
        );

        Cache::flush();

        return self::SUCCESS;
    }

    protected function updateEverything(): void
    {
        $values = collect($this->lines)
            ->map(fn (array $text, string $key) => [
                'group' => '*',
                'key' => $key,
                'text' => json_encode($text),
            ])
            ->all();

        LanguageLine::truncate();

        LanguageLine::insert($values);

        $this->info('Replaced all database translations.');
    }

    protected function updateMissing(): void
    {
        $existingLines = LanguageLine::query()
            ->where('group', '*')
            ->get();

        $newLines = collect();

        foreach ($this->lines as $key => $text) {
            $existingLine = $existingLines->firstWhere('key', $key);

            if (! \is_null($existingLine) && \array_key_exists($key, $existingLine->text)) {
                continue;
            }

            $newLines->push([
                'group' => '*',
                'key' => $key,
                'text' => json_encode(array_merge($existingLine->text, $text)),
            ]);
        }

        if ($newLines->isNotEmpty()) {
            LanguageLine::upsert($newLines->all(), ['group', 'key'], ['text']);

            $this->info("Added {$newLines->count()} missing database translations.");
        } else {
            $this->info('Translations already up to date.');
        }
    }
}
