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
        Schema::create('decision_categories', function (Blueprint $table) {
            $table->commonFields(published: false);

            $table->json('title')->nullable()->fulltext();
            $table->json('slug')->nullable();
            $table->json('description')->nullable()->fulltext();
        });

        Schema::create('category_decision', function (Blueprint $table) {
            $table->id();

            $table->foreignId('decision_category_id')
                ->constrained('decision_categories')
                ->cascadeOnDelete();

            $table->foreignId('decision_id')
                ->constrained('decisions')
                ->cascadeOnDelete();
        });
    }
};
