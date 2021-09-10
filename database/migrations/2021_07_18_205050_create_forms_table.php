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
        Schema::create('forms', function (Blueprint $table) {
            $this->createCommonFields($table);

            $table->boolean('store_submissions')->default(false);
            $table->boolean('send_submissions')->default(false);
            $table->json('recipients')->nullable();
        });

        Schema::create('form_translations', function (Blueprint $table) {
            $this->createTranslationFields($table, 'form');

            $table->string('title')->nullable();
        });
    }
};
