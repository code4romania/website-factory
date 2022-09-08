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
        Schema::create('partners', function (Blueprint $table) {
            $table->commonFields();

            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('position')->nullable();
        });
    }
};
