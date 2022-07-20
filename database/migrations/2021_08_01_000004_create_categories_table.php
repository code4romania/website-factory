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
        Schema::create('categories', function (Blueprint $table) {
            $table->commonFields(softDeletes: false, published: false);

            $table->json('title')->nullable();

            $table->nestedSet();
        });

        Schema::create('model_has_categories', function (Blueprint $table) {
            $table->foreignId('category_id')->index();
            $table->morphs('model');
        });
    }
};
