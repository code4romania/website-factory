<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class FormResource extends Resource
{
    public array $routeMap = [
        'admin.forms.index'  => 'index',
        // 'admin.forms.show'   => 'show',
        // 'admin.forms.create' => 'task',
        // 'admin.forms.edit'   => 'task',
    ];

    protected function index(Request $request): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }

    protected function default(Request $request): array
    {
        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'blocks' => $this->blocks,
        ];
    }
}
