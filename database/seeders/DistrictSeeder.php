<?php

namespace Database\Seeders;

use App\Models\Provision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path(); // Get the absolute path to the public folder

        $contents = File::allFiles($publicPath . '/data/districtsByProvince');
        foreach ($contents as $item) {
            $this->storeInDatabase($item->getFilename());
        }
    }
    private function storeInDatabase($districts_name)
    {
        $data = json_decode(file_get_contents(public_path() . '/data/districtsByProvince/' . $districts_name), true);

        $f = explode('.', $districts_name);
        $provision = $f[0];
        // dd($provision);
        foreach ($data as $items) {

            foreach ($items as $item) {
                $districts[] = [
                    'provision_id' => $this->getProvisionId($provision),
                    'districts_name' => $item,
                ];
            }
            DB::table('districts')->insert($districts);
        }
    }
    private function getProvisionId($provision)
    {
        $provision_id = Provision::where('provision_name', $provision)->first();
        // dd($provision_id);
        // Fetch provision_id from database or generate a new one based on your requirement
        return $provision_id->id;
    }
}
