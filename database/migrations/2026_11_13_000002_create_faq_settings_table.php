<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('FREQUENTLY ASKED QUESTIONS');
            $table->string('subtitle')->default('Answers to the questions we hear most');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_settings');
    }
};
