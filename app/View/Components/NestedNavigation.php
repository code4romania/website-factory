<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Kalnoy\Nestedset\Collection;

class NestedNavigation extends Component
{
    public ?Collection $items = null;

    public Model $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        if (! SupportsTrait::nestedSet($model)) {
            return;
        }

        if ($model->isRoot() && $model->isLeaf()) {
            return;
        }

        $this->items = $model->nestedNavigation(
            columns: ['title', 'slug']
        );
    }

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender(): bool
    {
        return $this->items !== null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nested-navigation.main');
    }
}
