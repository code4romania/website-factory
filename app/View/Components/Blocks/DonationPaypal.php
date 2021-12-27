<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Services\Features;

class DonationPaypal extends BlockComponent
{
    public ?string $title;

    public ?string $text;

    public string $button_id;

    public bool $popup;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->text = $this->block->translatedInput('text');

        $this->button_id = $this->block->input('button_id');

        $this->popup = $this->block->checkbox('popup');
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender(): bool
    {
        return Features::hasDonations();
    }
}
