<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('slug');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('supplier_id');
            $table->string('product_image')->nullable();
            $table->string('product_store')->nullable();
            $table->string('product_code');
            $table->string('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
             $table->text('product_description')->nullable();
              $table->text('product_features')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
