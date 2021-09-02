<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasRole
{
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
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
