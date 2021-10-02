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
            ->map(fn (SplFileInfo $file) => [
                'icon' => '', // TODO: get component icon
                'type' => Str::kebab(preg_replace('/(.vue|.js)$/u', '', $file->getFilename())),
            ]);
    }
}
