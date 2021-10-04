<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class BlockTypeCollection extends Collection
{
    private Filesystem $filesystem;

    public ?string $source;

    public function __construct()
    {
        $this->filesystem = app(Filesystem::class);

        parent::__construct($this->getBlockList());
    }

    private function getBlockList(): ?iterable
    {
        $source = config('blocks.source_dir', resource_path('js/components/Blocks/Type'));

        if (! $this->filesystem->exists($source)) {
            return null;
        }

        return collect($this->filesystem->files($source))
            ->map(fn (SplFileInfo $file) => $this->getBlockInfo($file));
    }

    private function getBlockInfo(SplFileInfo $file): array
    {
        $component = (string) Str::of($this->filesystem->get($file))
            ->after('<script>')
            ->before('</script>');

        return [
            'icon' => $this->getProperty('icon', $component) ?? config('blocks.default_icon', 'Design/layout-top-2-line'),
            'type' => $this->getProperty('type', $component) ?? Str::kebab(preg_replace('/(.vue|.js)$/u', '', $file->getFilename())),
        ];
    }

    private function getProperty(string $name, string $subject): ?string
    {
        preg_match("/^\\s+{$name}: '([a-z0-9\/-]+)',$/uim", $subject, $matches);

        return $matches[1] ?? null;
    }
}
