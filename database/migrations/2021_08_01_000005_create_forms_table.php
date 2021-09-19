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
        Schema::create('forms', function (Blueprint $table) {
            $table->commonFields();

            $table->boolean('store_submissions')->default(false);
            $table->boolean('send_submissions')->default(false);
            $table->json('recipients')->nullable();

            $table->json('title')->nullable();
        });
    }
};
