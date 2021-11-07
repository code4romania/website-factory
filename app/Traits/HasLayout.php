<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

trait HasLayout
{
    public function initializeHasLayout(): void
    {
        $this->fillable[] = 'layout';
    }

    public function view(array $data = [], array $mergeData = []): View
    {
        $stack = collect([$this->layout, 'default'])
            ->map(fn ($layout) => 'front.' . $this->getTable() . '.' . $layout)
            ->all();

        return view()->first($stack, $data, $mergeData);
    }

    public function getAvailableLayouts(): Collection
    {
        return collect(\glob(resource_path("views/front/{$this->getTable()}/*.blade.php")))
            ->map(fn (string $path) => \preg_replace('/.blade.php$/ui', '', \basename($path)));
    }
}
