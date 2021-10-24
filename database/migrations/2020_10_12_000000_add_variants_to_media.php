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
        Schema::table('media', function (Blueprint $table) {
            $table->string('variant_name')
                ->after('size')
                ->nullable();

            $table->foreignId('original_media_id')
                ->after('variant_name')
                ->nullable()
                ->references('id')
                ->on('media')
                ->constrained()
                ->nullOnDelete();
        });
    }
};
