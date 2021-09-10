<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class BlockCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function loadBlocks(): self
    {
        $filesystem = app(Filesystem::class);

        $this->items = collect($filesystem->files(config('blocks.source_dir')))
            ->map(fn (SplFileInfo $file) => [

            ]);

        return $this;
    }
}
