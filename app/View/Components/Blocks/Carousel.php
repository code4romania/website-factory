<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use Illuminate\Support\Collection;

class Carousel extends BlockComponent
{
    public Collection $items;

    public function setup(): void
    {
        $this->items = $this->block->children
            ->loadMissing('media')
            ->map(function (Block $block) {
                $image = $block->firstMedia('image');

                $item = [
                    'title'                 => $block->translatedInput('title'),
                    'text'                  => $block->translatedInput('text'),
                    'image'                 => $image,
                    'color_overlay_enabled' => $image !== null ? $block->checkbox('color_overlay_enabled') : false,
                    'color_overlay'         => $image !== null ? $block->input('color_overlay') : false,
                    'image_as_background'   => $image !== null ? $block->checkbox('image_as_background') : false,
                    'button_url'            => $block->translatedInput('button_url'),
                    'button_text'           => $block->translatedInput('button_text'),
                ];

                $item['component'] = $this->getComponent($item);

                return $item;
            });
    }

    protected function getComponent(array $item): string
    {
        if ($item['image_as_background']) {
            return 'blocks.carousel.bg_image';
        } elseif ($item['image'] !== null) {
            return 'blocks.carousel.side_image';
        } else {
            return 'blocks.carousel.plain';
        }
    }
}
