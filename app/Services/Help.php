<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Symfony\Component\Finder\SplFileInfo;

class Help
{
    public static function all(): Collection
    {
        return static::getAllFiles()
            ->map(function (Collection $topics, string $section) {
                [$id, $name] = static::splitFilename($section);

                return [
                    'section' => $name,
                    'topics'  => $topics->map(function (SplFileInfo $file) {
                        $markdown = static::markdown($file->getContents());
                        $frontMatter = $markdown->getFrontMatter();

                        [$id, $name] = static::splitFilename($file->getFilenameWithoutExtension());

                        $content = $markdown->getContent();

                        return [
                            'id'      => $id,
                            'topic'   => $name,
                            'title'   => data_get($frontMatter, 'title'),
                            'excerpt' => Str::of((string) $content)
                                ->stripTags()
                                ->limit(160)
                                ->toString(),
                            'content' => $content,
                        ];
                    }),
                ];
            });
    }

    private static function getAllFiles(): Collection
    {
        $filesystem = app(Filesystem::class);

        $locales = [
            config('app.locale'),
            config('app.fallback_locale'),
        ];

        foreach ($locales as $locale) {
            $path = resource_path("help/{$locale}");

            if ($filesystem->exists($path) && $filesystem->isDirectory($path)) {
                return collect($filesystem->allFiles($path))
                    ->reject(fn (SplFileInfo $file) => $file->getFilenameWithoutExtension() === '_index')
                    ->groupBy(fn (SplFileInfo $file) => $file->getRelativePath());
            }
        }

        return collect();
    }

    private static function markdown(string $content): RenderedContentWithFrontMatter
    {
        $converter = new MarkdownConverter(
            (new Environment())
                ->addExtension(new CommonMarkCoreExtension())
                ->addExtension(new FrontMatterExtension())
                ->addExtension(new ExternalLinkExtension())
                ->addExtension(new GithubFlavoredMarkdownExtension())
        );

        return $converter->convert($content);
    }

    private static function splitFilename(string $filename): array
    {
        return explode('-', $filename, 2);
    }
}
