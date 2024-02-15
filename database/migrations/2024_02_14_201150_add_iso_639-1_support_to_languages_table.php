<?php

declare(strict_types=1);

use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        Language::all()
            ->each(function (Language $language) {
                $language->update([
                    'code' => Str::lower($language->code),
                ]);
            });
    }
};
