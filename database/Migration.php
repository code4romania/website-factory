<?php

declare(strict_types=1);

namespace Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;

abstract class Migration extends BaseMigration
{
    protected function createCommonFields(Blueprint $table, bool $softDeletes = true, bool $published = true): void
    {
        $table->id();
        $table->timestamps();

        if ($softDeletes) {
            $table->softDeletes();
        }

        if ($published) {
            $table->timestamp('publish_start_at')->nullable();
            $table->timestamp('publish_end_at')->nullable();
        }
    }

    protected function createTranslationFields(Blueprint $table, string $singular, ?string $plural = null): void
    {
        $plural ??= Str::plural($singular);

        $table->id();
        $table->foreignId("{$singular}_id")->constrained()->cascadeOnDelete();

        $table->timestamps();
        $table->softDeletes();
        $table->string('locale', 2)->index();
        $table->boolean('active')->default(false);

        $table->unique(["{$singular}_id", 'locale']);
    }

    protected function createSlugFields(Blueprint $table, string $singular, ?string $plural = null): void
    {
        $plural ??= Str::plural($singular);

        $table->id();
        $table->foreignId("{$singular}_id")->constrained()->cascadeOnDelete();

        $table->timestamps();
        $table->softDeletes();
        $table->string('locale', 2)->index();

        $table->string('slug');

        $table->unique(['slug', 'locale']);
    }
}
