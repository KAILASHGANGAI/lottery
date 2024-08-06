<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Ownerseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        
        \App\Models\Owner::create([
            'company_name' => 'My Company',
            'email' => 'admin@admin.com',
            'contact'=> '+977987365407',
            'owner_name'=> 'My name Is like this',
            'reg_number'=> '136542',
            'pan_number'=> '1265478'
        ]);
    }
}
