<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Gaupalika;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistrict($provision_id)
    {
        $datas = District::select(['id', 'districts_name'])->where('provision_id', $provision_id)->get();
        return response()->json($datas);
    }
    public function getGaupalika($district_id)
    {
        $datas = Gaupalika::select(['id', 'gaupalika_name'])->where('district_id', $district_id)->get();
        return response()->json($datas);
    }
}
