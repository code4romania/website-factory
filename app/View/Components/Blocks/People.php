<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Person;
use Illuminate\Support\Collection;

class People extends BlockComponent
{
    public ?string $title;

    public ?string $html;

    public Collection $people;

    public bool $show_images;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->html = $this->block->translatedInput('text');

        $this->people = Person::query()->withMedia()->take(4)->get();

        $this->show_images = $this->block->checkbox('show_images');
    }
}
