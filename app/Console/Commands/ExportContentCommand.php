<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Block;
use App\Models\Form;
use App\Models\Page;
use App\Models\Person;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\HTMLToMarkdown\HtmlConverter;

class ExportContentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:content:export {--locale=en : Locale to export}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export content to flat json files.';

    protected HtmlConverter $htmlConverter;

    protected array $validBlockFields = [
        'button_text',
        'button_url',
        'caption',
        'description',
        'label',
        'options',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'text',
        'title',
        'url',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->htmlConverter = new HtmlConverter([
            'header_style' => 'atx',
            'strip_tags' => true,
        ]);
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->exportPages();

        $this->exportPosts();

        $this->exportForms();

        $this->exportPeople();

        return self::SUCCESS;
    }

    protected function writeToFile(string $filename, Collection $content): void
    {
        Storage::disk('local')->put("exports/{$filename}", $content->toJson(\JSON_PRETTY_PRINT));
    }

    protected function html2md(?string $content): ?string
    {
        if (\is_string($content)) {
            return $this->htmlConverter->convert($content);
        }

        return $content;
    }

    protected function mapBlocks(Collection $blocks)
    {
        return $blocks
            ->map(
                fn (Block $block) => collect($block->content)
                    ->reject(fn ($field) => \in_array($field, $this->validBlockFields))
                    ->map(function ($field) {
                        $content = data_get($field, $this->option('locale'));

                        if (\is_string($content)) {
                            $content = $this->html2md($content);
                        }

                        return $content;
                    })
                    ->put('children', $this->mapBlocks($block->children))
                    ->filter()
                    ->all()
            )
            ->filter()
            ->dot()
            ->all();
    }

    protected function exportPages(): void
    {
        $this->writeToFile(
            'pages.json',
            Page::query()
                ->with('blocks')
                ->get()
                ->mapWithKeys(fn (Page $model) => [
                    "{$model->id}.{$model->title}" => [
                        'title' => $this->html2md($model->title),
                        'description' => $this->html2md($model->description),
                        'blocks' => $this->mapBlocks($model->blocks),
                    ],
                ])
                ->dot()
                ->filter()
        );
    }

    protected function exportPosts(): void
    {
        $this->writeToFile(
            'post-categories.json',
            PostCategory::query()
                ->get()
                ->mapWithKeys(fn (PostCategory $model) => [
                    "{$model->id}.{$model->title}" => [
                        'title' => $this->html2md($model->title),
                        'description' => $this->html2md($model->description),
                    ],
                ])
                ->dot()
                ->filter()
        );

        $this->writeToFile(
            'posts.json',
            Post::query()
                ->with('blocks')
                ->get()
                ->mapWithKeys(fn (Post $model) => [
                    "{$model->id}.{$model->title}" => [
                        'title' => $this->html2md($model->title),
                        'description' => $this->html2md($model->description),
                        'blocks' => $this->mapBlocks($model->blocks),
                    ],
                ])
                ->dot()
                ->filter()
        );
    }

    protected function exportForms(): void
    {
        $this->writeToFile(
            'forms.json',
            Form::query()
                ->with('blocks')
                ->get()
                ->mapWithKeys(fn (Form $model) => [
                    "{$model->id}.{$model->title}" => [
                        'title' => $this->html2md($model->title),
                        'description' => $this->html2md($model->description),
                        'blocks' => $this->mapBlocks($model->blocks),
                    ],
                ])
                ->dot()
                ->filter()
        );
    }

    protected function exportPeople(): void
    {
        $this->writeToFile(
            'people.json',
            Person::query()
                ->with('blocks')
                ->get()
                ->mapWithKeys(fn (Person $model) => [
                    "{$model->id}.{$model->name}" => [
                        'title' => $this->html2md($model->title),
                        'description' => $this->html2md($model->description),
                        'blocks' => $this->mapBlocks($model->blocks),
                    ],
                ])
                ->dot()
                ->filter()
        );
    }
}
