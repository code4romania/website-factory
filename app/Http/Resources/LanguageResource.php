<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\LanguageLine;
use Illuminate\Http\Request;

class LanguageResource extends Resource
{
    protected function default(Request $request): array
    {
        return [
            'id' => $this->code,
            'code' => $this->code,
            'name' => $this->name,
            'enabled' => $this->enabled,
            'lines' => LanguageLine::getTranslationsForGroup($this->code, '*'),
        ];
    }
}
