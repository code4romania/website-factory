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
        Schema::create('language_lines', function (Blueprint $table) {
            $table->string('group')->index();
            $table->string('key');
            $table->json('text');

            $table->unique(['group', 'key']);
        });
    }
};
