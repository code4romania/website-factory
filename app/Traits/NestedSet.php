<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\SupportsTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\QueryBuilder;

trait NestedSet
{
    use NodeTrait;

    public function initializeNestedSet(): void
    {
        $this->fillable[] = 'parent';
    }

    public function newNestedSetQuery($table = null): QueryBuilder
    {
        $isAdminRoute = Str::startsWith(Route::currentRouteName(), 'admin.');

        $builder = $this->newQuery()
            ->when(
                SupportsTrait::softDeletes($this),
                fn (Builder $query) => $query->withTrashed()
            )
            ->when(
                $isAdminRoute && SupportsTrait::publishable($this),
                fn (Builder $query) => $query->withDrafted()
            );

        return $this->applyNestedSetScope($builder, $table);
    }

    public function setParentAttribute(?int $id = null)
    {
        return \is_null($id)
            ? $this->makeRoot()
            : $this->appendToNode(self::find($id));
    }

    public function nestedNavigation(array $columns = [])
    {
        $treeColumns = ['id', 'parent_id', '_lft', '_rgt'];

        return $this->newQuery()
            ->select(array_merge($treeColumns, $columns))
            ->descendantsAndSelf(
                $this->isRoot()
                    ? $this
                    : $this->ancestors()
                        ->select($treeColumns)
                        ->whereIsRoot()
                        ->first()
            )
            ->toTree();
    }
}
