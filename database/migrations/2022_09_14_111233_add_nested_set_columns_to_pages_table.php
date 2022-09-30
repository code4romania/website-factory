<?php

declare(strict_types=1);

use App\Models\Page;
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
        Schema::table('pages', function (Blueprint $table) {
            $table->nestedSet();
        });

        Page::withoutGlobalScope('published')->fixTree();
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropNestedSet();
        });
    }
};
