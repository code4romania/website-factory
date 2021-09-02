<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResource extends Resource
{
    public array $routeMap = [
        'admin.users.index'  => 'index',
        // 'admin.users.show'   => 'show',
        // 'admin.users.create' => 'task',
        // 'admin.users.edit'   => 'task',
    ];

    protected function index(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
