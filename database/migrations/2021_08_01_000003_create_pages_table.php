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
        Schema::create('pages', function (Blueprint $table) {
            $table->commonFields();

            $table->json('title')->nullable()->fulltext();
            $table->json('slug')->nullable();
            $table->json('description')->nullable()->fulltext();
        });
    }
};
