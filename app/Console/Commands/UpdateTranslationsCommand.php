<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\LanguageLine;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

class UpdateTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:update-translations {--force : Overwrite existing translations}';

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
        collect(File::files(lang_path()))
            ->each(function (SplFileInfo $file) {
                $language = $file->getFilenameWithoutExtension();

                try {
                    $lines = json_decode(File::get($file->getPath()), true);
                } catch (Throwable $th) {
                    $this->warn("Could not fetch the contents of {$file->getFilename()}. Skipping...");
                    $lines = [];
                }

                collect($lines)
                    ->each(function ($line, $key) use ($language) {
                        $this->lines[$key][$language] = $line;
                    });

                $this->info("[$language] Fetched " . \count($lines) . ' translations.');
            });

        LanguageLine::withoutEvents(
            fn () => $this->option('force')
                ? $this->updateEverything()
                : $this->updateMissing()
        );

        Cache::flush();

        $this->info('Done!');

        return self::SUCCESS;
    }

    protected function updateEverything(): void
    {
        $this->info('Replacing existing database translations...');

        $values = collect($this->lines)
            ->map(fn (array $text, string $key) => [
                'group' => '*',
                'key'   => $key,
                'text'  => json_encode($text),
            ])
            ->all();

        LanguageLine::upsert($values, ['group', 'key'], ['text']);
    }

    protected function updateMissing(): void
    {
        $this->info('Adding missing database translations...');

        foreach ($this->lines as $key => $text) {
            LanguageLine::firstOrCreate(
                [
                    'group' => '*',
                    'key'   => $key,
                ],
                [
                    'text' => $text,
                ]
            );
        }
    }
}
