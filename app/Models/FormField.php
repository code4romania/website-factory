<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Collection;

class FormField extends Block
{
    public $table = 'blocks';

    public function getComponentAttribute(): string
    {
        return "blocks.form.{$this->type}";
    }

    public function getNameAttribute(): string
    {
        return "field-{$this->id}";
    }

    public function getXModelAttribute(): string
    {
        return "form['{$this->name}']";
    }

    public function options(string $field = 'options'): Collection
    {
        $rawOptions = $this->translatedInput($field) ?? $this->input($field);

        if (! \is_string($rawOptions)) {
            $rawOptions = '';
        }

        return collect(preg_split('/\r\n|\r|\n/', $rawOptions))
            ->filter();
    }
}
