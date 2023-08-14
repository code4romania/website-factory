<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('page_groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('title')->nullable()->fulltext();
        });

        Schema::create('page_group_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_group_id')
                ->constrained('page_groups')
                ->cascadeOnDelete();

            $table->foreignId('page_id')
                ->constrained('pages')
                ->cascadeOnDelete();

            $table->nestedSet();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropNestedSet();
        });
    }
};
