<?php

declare(strict_types=1);

use Database\Migration;
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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();

            $table->json('data')->nullable();

            $table->foreignId('form')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
        });
    }
};
