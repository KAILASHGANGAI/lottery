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
        Schema::create('depositeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('cid')->nullable();
            $table->unsignedBigInteger('deposite_amount')->comment('Deposit amount');
            $table->unsignedBigInteger('fine_amount')->comment('Fine amount');
            $table->unsignedBigInteger('due')->nullable()->comment('Due left amount');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->datetimes('dod');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depositeds');
    }
};
