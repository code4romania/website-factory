<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Budget extends BlockComponent
{
    public array $chartData = [];

    public string $dataKey;

    public function setup(): void
    {
        $this->dataKey = 'budgetData' . $this->id;

        $this->chartData = $this->block->input('data');
    }
}
