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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('location')->index();
            $table->string('type');
            $table->json('label');
            $table->json('url')->nullable();

            $table->nullableMorphs('model');
            $table->unsignedInteger('position');

            $table->nestedSet();
        });
    }
};
