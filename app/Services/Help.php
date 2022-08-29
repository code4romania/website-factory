<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Embed\Bridge\OscaroteroEmbedAdapter;
use League\CommonMark\Extension\Embed\Embed;
use League\CommonMark\Extension\Embed\EmbedExtension;
use League\CommonMark\Extension\Embed\EmbedRenderer;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Renderer\HtmlDecorator;
use Symfony\Component\Finder\SplFileInfo;

class Help
{
    public static function all(): Collection
    {
        return Cache::rememberForever(
            'admin-help-' . app()->getLocale(),
            fn () => static::getAllFiles()
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
                ->values()
        );
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
                    ->reject(fn (SplFileInfo $file) => $file->getFilenameWithoutExtension() === '_index');
            }
        }

        return collect();
    }

    private static function markdown(string $content): RenderedContentWithFrontMatter
    {
        $environment = new Environment([
            'embed' => [
                'adapter' => new OscaroteroEmbedAdapter(),
                'allowed_domains' => ['youtube.com'],
                'fallback' => 'link',
            ],
        ]);

        $environment->addExtension(new CommonMarkCoreExtension())
            ->addExtension(new AttributesExtension())
            ->addExtension(new FrontMatterExtension())
            ->addExtension(new EmbedExtension())
            ->addExtension(new ExternalLinkExtension())
            ->addExtension(new GithubFlavoredMarkdownExtension())
            ->addRenderer(Embed::class, new HtmlDecorator(new EmbedRenderer(), 'div', ['class' => 'aspect-w-16 aspect-h-9']));

        return (new MarkdownConverter($environment))->convert($content);
    }

    private static function splitFilename(string $filename): array
    {
        return explode('-', $filename, 2);
    }
}
