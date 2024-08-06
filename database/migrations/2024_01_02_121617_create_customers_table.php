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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cid')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('provision_id');
            $table->foreignId('district_id');
            $table->foreignId('gaupalika_id');
            $table->string('ward_no')->nullable();
            $table->bigInteger('lottery_amount')->nullable();
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->string('occupation')->nullable();
            $table->string('salary')->nullable();
            $table->string('wlocation')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('hf_name')->nullable(); // husband or wife name
            $table->string('no_of_members')->nullable(); // husband or wife name
            $table->string("refered_by")->nullable();
            $table->string("reg_date")->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
