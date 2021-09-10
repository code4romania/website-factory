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
        Schema::create('pages', function (Blueprint $table) {
            $this->createCommonFields($table);
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $this->createTranslationFields($table, 'page');

            $table->string('title')->nullable();
        });

        // Schema::create('page_slugs')
    }
};
