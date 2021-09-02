<?php

declare(strict_types=1);

namespace App\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

abstract class Translation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $model = null;

    public function getFillable()
    {
        $fillable = Arr::wrap($this->fillable);

        if (! \count($fillable)) {
            $fillable = (new ($this->getBaseModel()))->translatedAttributes ?? [];
        }

        return $fillable;
    }

    protected function getBaseModel(): string
    {
        $model = preg_replace('/Translation$/u', '', \class_basename($this));

        return "App\\Models\\$model";
    }
}
