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
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('image')->nullable();
            $table->string('availabel_quantity')->nullable();
            $table->string('sold_quantity')->nullable();
            $table->integer('recommendation')->default(10);
            $table->softDeletes();
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
