<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class GaupalikaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path(); // Get the absolute path to the public folder

        $contents = File::allFiles($publicPath . '/data/municipalsByDistrict');
        // dd($contents);
        foreach ($contents as $item) {
            // dd($item->getFilename());
            $this->storeInDatabase($item->getFilename());
        }
    }
    private function storeInDatabase($districts_name)
    {
        $data = json_decode(file_get_contents(public_path() . '/data/municipalsByDistrict/' . $districts_name), true);

        $f = explode('.', $districts_name);
        $district = $f[0];
        // dd($district);
        foreach ($data as $items) {

            foreach ($items as $item) {
                $districts[] = [
                    'district_id' => $this->getDistrictId($district),
                    'gaupalika_name' => $item,
                ];
            }
            DB::table('gaupalikas')->insert($districts);
        }
    }
    private function getDistrictId($district)
    {
        $provision_id = District::where('districts_name', $district)->first();
        // dd($provision_id);
        // Fetch provision_id from database or generate a new one based on your requirement
        return $provision_id->id;
    }
}
