<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Services\PaymentGateway;

class DonationEuplatesc extends BlockComponent
{
    public ?string $title;

    public ?string $text;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->text = $this->block->translatedInput('text');
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender(): bool
    {
        return PaymentGateway::isActive('euplatesc');
    }
}
