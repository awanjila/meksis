<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('section_label')->nullable();
            $table->string('headline')->nullable();
            $table->string('highlight_word')->nullable();
            $table->text('paragraph_one')->nullable();
            $table->text('paragraph_two')->nullable();
            $table->string('stat_one_number', 50)->nullable();
            $table->string('stat_one_label', 100)->nullable();
            $table->string('stat_two_number', 50)->nullable();
            $table->string('stat_two_label', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'section_label',
                'headline',
                'highlight_word',
                'paragraph_one',
                'paragraph_two',
                'stat_one_number',
                'stat_one_label',
                'stat_two_number',
                'stat_two_label',
            ]);
        });
    }
};
