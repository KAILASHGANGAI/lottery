<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProvisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            "bagmati",
            "sudurpaschim",
            "lumbini",
            "koshi",
            "madhesh",
            "gandaki",
            "karnali"
        ];

        foreach ($provinces as $province) {
        

            DB::table('provisions')->insert([
                'provision_name' => $province
            ]);
        }
    }
}
