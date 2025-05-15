<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Form;
use App\Models\Page;
use App\Models\Person;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class ExportSeedDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:export:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export content to seed json files.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->exportPages();

        $this->exportForms();

        $this->exportPeople();

        return self::SUCCESS;
    }

    protected function exportPages(): void
    {
        $pages = Page::query()
            ->withDrafted()
            ->with('blocks')
            ->get([
                'id',
                'title',
                'slug',
                'description',
                'published_at',
            ])
            ->toArray();

        $this->writeToFile(
            'pages.json',
            collect($pages)
                ->map(fn (array $page) => [
                    ...$this->mapToSetting($page),
                    'title' => $this->sanitize($page['title']),
                    'slug' => $this->sanitize($page['slug']),
                    'description' => $this->sanitize($page['description']),
                    'published_at' => $page['published_at'] ? 'now' : null,
                    'blocks' => $this->mapBlocks($page['blocks']),
                ])
        );
    }

    protected function exportForms(): void
    {
        $forms = Form::query()
            ->with('blocks')
            ->get([
                'id',
                'title',
                'slug',
                'description',
                'store_submissions',
                'send_submissions',
                'recipients',
            ])
            ->toArray();

        $this->writeToFile(
            'forms.json',
            collect($forms)
                ->map(fn (array $form) => [
                    'title' => $this->sanitize($form['title']),
                    'slug' => $this->sanitize($form['slug']),
                    'description' => $this->sanitize($form['description']),
                    'store_submissions' => $form['store_submissions'],
                    'send_submissions' => $form['send_submissions'],
                    'recipients' => $form['recipients'],
                    'blocks' => $this->mapBlocks($form['blocks']),
                ])
        );
    }

    protected function exportPeople(): void
    {
        $people = Person::query()
            ->with('blocks')
            ->get([
                'id',
                'name',
                'slug',
                'title',
                'description',
                'social',
            ])
            ->toArray();

        $this->writeToFile(
            'people.json',
            collect($people)
                ->map(fn (array $person) => [
                    'name' => $person['name'],
                    'slug' => $person['slug'],
                    'title' => $this->sanitize($person['title']),
                    'description' => $this->sanitize($person['description']),
                    'social' => $person['social'],
                    'blocks' => $this->mapBlocks($person['blocks']),
                ])
        );
    }

    private function mapBlocks(array $blocks): Collection
    {
        return collect($blocks)
            ->map(fn (array $block) => [
                'type' => $block['type'],
                'content' => $block['content'],
            ]);
    }

    private function mapToSetting(array $page): array
    {
        $settings = settings('site');
        $pages = ['front_page', 'terms_page', 'privacy_page'];

        foreach ($pages as $key) {
            if (data_get($settings, $key) === $page['id']) {
                return [
                    '_map_to_setting' => ['site', $key],
                ];
            }
        }

        return [];
    }

    private function writeToFile(string $filename, Collection $content): void
    {
        $edition = config('website-factory.edition');
        $path = database_path("seeders/data/{$edition}/{$filename}");

        File::ensureDirectoryExists(\dirname($path));

        if ($content->isEmpty()) {
            File::delete($path);
        } else {
            File::put($path, $content->toJson(\JSON_PRETTY_PRINT));
        }
    }

    private function sanitize(array $content): array
    {
        return collect($content)
            ->filter()
            ->all();
    }
}
