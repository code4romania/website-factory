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
        Schema::create('related', function (Blueprint $table) {
            $table->numericMorphs('subject');
            $table->numericMorphs('related');
            $table->unsignedInteger('position');
        });
    }
};
