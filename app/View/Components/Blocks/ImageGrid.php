<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ImageGrid extends Component
{
    public ?string $title;

    public Collection $images;

    public string $columns;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->images = $block->getMedia('image');

        $this->columns = $this->getColumns($block->input('columns'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.image-grid');
    }

    private function getColumns($columns): string
    {
        switch ($columns) {
            default:
            case 1:
                return 'md:grid-cols-1';
                break;

            case 2:
                return 'md:grid-cols-2';
                break;

            case 3:
                return 'md:grid-cols-3';
                break;

            case 4:
                return 'md:grid-cols-4';
                break;

            case 5:
                return 'md:grid-cols-5';
                break;

        }
    }
}
