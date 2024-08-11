<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function store(Request $request){
        Lottery::create($request->all());
        return back()->with('success', 'Saved Successfully');
    }
    public function update(Request $request , Lottery $Lottery){
        $Lottery->update($request->all());
        return back()->with('success', 'Saved Successfully');

    }
}
