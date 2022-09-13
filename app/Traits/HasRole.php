<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait HasRole
{
    public function initializeHasRole()
    {
        $this->casts['role'] = UserRole::class;
    }

    public function hasRole(string $role): bool
    {
        return $this->role === UserRole::tryFrom($role);
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::admin;
    }

    public function isEditor(): bool
    {
        return $this->role === UserRole::editor;
    }

    public function scopeRole(Builder $query, array|string|Collection|UserRole $roles): Builder
    {
        return $query->whereIn('role', collect($roles));
    }
}
