<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class BlockResource extends Resource
{
    public array $routeMap = [
        // 'admin.users.index'  => 'index',
        // 'admin.users.show'   => 'show',
        // 'admin.users.create' => 'task',
        // 'admin.users.edit'   => 'task',
    ];

    protected function default(Request $request): array
    {
        $this->withoutPermissions();

        return [
            'id'      => $this->id,
            'type'    => $this->type,
            'content' => $this->content,
        ];
    }
}
