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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->foreignId('provision_id');
            $table->foreignId('district_id');
            $table->foreignId('gaupalika_id');
            $table->string('ward_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->string('joiningdate')->nullable();
            $table->boolean('status')->default(0);
            $table->string('photo')->nullable();
            $table->string('salary')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
