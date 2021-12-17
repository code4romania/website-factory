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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();
            $table->morphs('blockable');
            $table->unsignedInteger('position');
            $table->json('content');

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('blocks')
                ->cascadeOnDelete();
        });
    }
};
