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

        $this->chartData = $this->prepareChartData(
            $this->block->input('data')
        );
    }

    protected function prepareChartData(array $items): array
    {
        foreach ($items as &$item) {
            $item['name'] = localized_input($item['name']);

            if (\array_key_exists('children', $item)) {
                $item['children'] = $this->prepareChartData($item['children']);

                if (empty($item['children'])) {
                    unset($item['children']);
                } else {
                    unset($item['value']);
                }
            }
        }

        return $items;
    }
}
