<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->commonFields(published: false);

            $table->string('name');
            $table->string('slug')->nullable();
            $table->json('title')->nullable()->fulltext();
            $table->json('description')->nullable()->fulltext();
            $table->json('social')->nullable();
        });
    }
};
