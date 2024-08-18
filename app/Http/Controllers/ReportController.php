<?php

namespace App\Http\Controllers;

use App\Models\Deposited;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $datas = [];
        return view('report.index', compact('datas'));
    }
    public function search(Request $request)
    {
        $datas = $this->report($request, Deposited::query());
        return view('report.index', compact('datas'));
    }

    public function report($request, $class)
    {
        return $class
            ->when($request->cid, function ($query) use ($request) {
                $query->where('cid', $request->cid);
            })
            ->when($request->from_date || $request->to_date, function ($query) use ($request) {
                if ($request->from_date) {
                    $query->where('dod', '>=', $request->from_date);
                }
                if ($request->to_date) {
                    $query->where('dod', '<=', $request->to_date);
                }
            })
            ->get();
           
    }
}
