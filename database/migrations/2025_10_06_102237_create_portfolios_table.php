<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');                        // Project name
            $table->foreignId('category_id')                // Link to portfolio_categories
                  ->constrained('portfolio_categories')
                  ->onDelete('cascade');
            $table->text('description')->nullable();       // Short project overview
            $table->json('images')->nullable();            // Multiple images/screenshots
            $table->string('live_url')->nullable();        // Optional link for websites/demos
            $table->json('tech_stack')->nullable();        // e.g., ["Laravel", "Vue", "MySQL"]
            $table->text('key_features')->nullable();      // Highlights, e.g., "Attendance + Payroll Integration"
            $table->boolean('featured')->default(false);   // Show in hero section or highlights
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

