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
            $table->string('slug');
            $table->json('title');
            $table->json('description');
            $table->json('social')->nullable();
        });
    }
};
