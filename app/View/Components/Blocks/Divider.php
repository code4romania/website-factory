<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Divider extends BlockComponent
{
    public ?string $color;

    public function setup(): void
    {
        $this->color = $this->block->input('color');
    }
}
