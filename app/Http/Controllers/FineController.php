<?php

namespace App\Http\Controllers;

use App\Models\fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function store(Request $request){
        fine::create($request->all());
        return back()->with('success', 'Saved Successfully');
    }
    public function update(Request $request , fine $fine){
        $fine->update($request->all());
        return back()->with('success', 'Saved Successfully');

    }
}
