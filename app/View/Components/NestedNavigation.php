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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        if (
            ! SupportsTrait::nestedSet($model) ||
            $model->isRoot() && $model->isLeaf()
        ) {
            return;
        }

        $this->items = $model->query()
            ->select([
                'id', 'title', 'slug',
                'parent_id', '_lft', '_rgt',
            ])
            ->descendantsAndSelf(
                $model->isRoot()
                    ? $model
                    : $model->ancestors()
                        ->select(['id', 'parent_id', '_lft', '_rgt'])
                        ->whereIsRoot()
                        ->first()
            )
            ->toTree();
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
