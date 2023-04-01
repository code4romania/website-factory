<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;
use Symfony\Component\Finder\SplFileInfo;

class Help
{
    public static function all(): Collection
    {
        return static::getAllFiles()
            ->map(function (SplFileInfo $file, string $section) {
                $markdown = static::markdown($file->getContents());
                $frontMatter = $markdown->getFrontMatter();

                [$sectionId, $section] = static::splitFilename($file->getRelativePath());
                [$topicId, $topic] = static::splitFilename($file->getFilenameWithoutExtension());

                $content = $markdown->getContent();

                return [
                    'sectionId' => (int) $sectionId,
                    'section' => $section,
                    'topic' => $topic,
                    'title' => data_get($frontMatter, 'title'),
                    'video' => (bool) data_get($frontMatter, 'video'),
                    'content' => $content,
                    'excerpt' => Str::of((string) $content)
                        ->stripTags()
                        ->limit(160)
                        ->toString(),
                ];
            })
            ->values();
    }

    private static function getContentPath(string $locale): string
    {
        $edition = config('website-factory.edition');

        $edition = match ($edition) {
            'internal' => 'ong',
            default => $edition,
        };

        return base_path("help/content/{$edition}/{$locale}");
    }

    private static function getAllFiles(): Collection
    {
        $filesystem = app(Filesystem::class);

        $locales = [
            config('app.locale'),
            config('app.fallback_locale'),
        ];

        foreach ($locales as $locale) {
            $path = static::getContentPath($locale);

            if ($filesystem->exists($path) && $filesystem->isDirectory($path)) {
                return collect($filesystem->allFiles($path))
                    ->reject(fn (SplFileInfo $file) => $file->getFilenameWithoutExtension() === '_index');
            }
        }

        return collect();
    }

    private static function markdown(string $content): RenderedContentWithFrontMatter
    {
        $environment = new Environment([
            'heading_permalink' => [
                'html_class' => 'mr-2 no-underline inline-flex w-6 h-6 items-center justify-center focus:bg-blue-600 focus:text-blue-50',
                'min_heading_level' => 2,
                'max_heading_level' => 4,
            ],
            'table_of_contents' => [
                'html_class' => 'text-xs border-b pb-6 mb-6',
                'min_heading_level' => 2,
                'max_heading_level' => 4,
                'style' => 'ordered',
            ],
        ]);

        $environment
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new AutolinkExtension())
            ->addExtension(new AttributesExtension())
            ->addExtension(new FrontMatterExtension())
            ->addExtension(new TableExtension())
            ->addExtension(new ExternalLinkExtension())
            ->addExtension(new HeadingPermalinkExtension())
            ->addExtension(new TableOfContentsExtension());

        return (new MarkdownConverter($environment))->convert($content);
    }

    private static function splitFilename(string $filename): array
    {
        return explode('-', $filename, 2);
    }
}
