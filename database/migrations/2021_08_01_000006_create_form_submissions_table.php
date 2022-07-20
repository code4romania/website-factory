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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->commonFields();
            $table->uuid('uuid')->nullable()->unique();

            $table->json('data');

            $table->foreignId('form_id')
                ->constrained('forms')
                ->cascadeOnDelete();
        });
    }
};
