<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

class Budget extends BlockComponent
{
    public ?string $title;

    public ?string $html;

    public array $chartData = [];

    public string $dataKey;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->html = $this->block->translatedInput('text');

        $this->dataKey = 'budgetData' . $this->id;

        $this->chartData = $this->block->input('data');
    }
}
