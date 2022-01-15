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
        Schema::create('media', function (Blueprint $table) {
            $table->commonFields(softDeletes: false, published: false);

            $table->string('disk', 32);
            $table->string('directory');
            $table->string('filename');
            $table->string('extension', 32);
            $table->string('mime_type', 128);
            $table->string('aggregate_type', 32)->index();
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('size');

            $table->json('caption')->nullable();

            $table->unique(['disk', 'directory', 'filename', 'extension']);
        });

        Schema::create('mediables', function (Blueprint $table) {
            $table->foreignId('media_id')
                ->constrained('media')
                ->cascadeOnDelete();

            $table->morphs('mediable');
            $table->string('tag')->index();
            $table->unsignedInteger('order')->index();
        });
    }
};
