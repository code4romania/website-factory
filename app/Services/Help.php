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
use League\CommonMark\Extension\Table\TableExtension;
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
                    'section' => $section,
                    'topic'   => $topic,
                    'title'   => data_get($frontMatter, 'title'),
                    'excerpt' => Str::of((string) $content)
                        ->stripTags()
                        ->limit(160)
                        ->toString(),
                    'content' => $content,
                ];
            })
            ->values();
    }

    private static function getAllFiles(): Collection
    {
        $filesystem = app(Filesystem::class);

        $locales = [
            config('app.locale'),
            config('app.fallback_locale'),
        ];

        foreach ($locales as $locale) {
            $path = base_path("help/{$locale}");

            if ($filesystem->exists($path) && $filesystem->isDirectory($path)) {
                return collect($filesystem->allFiles($path))
                    ->reject(fn (SplFileInfo $file) => $file->getFilenameWithoutExtension() === '_index');
            }
        }

        return collect();
    }

    private static function markdown(string $content): RenderedContentWithFrontMatter
    {
        $environment = new Environment();

        $environment
            ->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new AutolinkExtension())
            ->addExtension(new AttributesExtension())
            ->addExtension(new FrontMatterExtension())
            ->addExtension(new TableExtension())
            ->addExtension(new ExternalLinkExtension());

        return (new MarkdownConverter($environment))->convert($content);
    }

    private static function splitFilename(string $filename): array
    {
        return explode('-', $filename, 2);
    }
}
