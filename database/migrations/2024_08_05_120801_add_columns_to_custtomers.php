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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('nominee_holder_name')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('nominee_phone')->nullable();

            $table->foreignId('temp_provision_id')->nullable();
            $table->foreignId('temp_district_id')->nullable();
            $table->foreignId('temp_gaupalika_id')->nullable();
            $table->string('temp_ward_no')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('nominee_holder_name');
            $table->dropColumn('nominee_relation');
            $table->dropColumn('nominee_phone');

            $table->dropColumn('temp_provision_id');
            $table->dropColumn('temp_district_id');
            $table->dropColumn('temp_gaupalika_id');
            $table->dropColumn('temp_ward_no');
        });
    }
};
