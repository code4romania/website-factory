<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Form as FormModel;

class Form extends BlockComponent
{
    public ?string $title;

    public FormModel $form;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');
        $this->form = $this->block->related
            ->pluck('related')
            ->first();
    }
}
