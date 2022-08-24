<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * @param  \Illuminate\Database\Eloquent\Builder                           $query
     * @param  array|string|\Illuminate\Support\Collection|\App\Enums\UserRole $roles
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRole(Builder $query, $roles): Builder
    {
        return $query->whereIn('role', collect($roles));
    }
}
