<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Deposited;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $datas = Deposited::where('created_at', date('Y-m-d'))->get();
        return view('report.index', compact('datas'));
    }
    public function agent(Request $request)
    {

        $agents = [];
        return view('report.agent', compact('agents'));
    }
    public function date(Request $request)
    {

        $datas = Deposited::where('created_at', date('Y-m-d'))->get();
        return view('report.date', compact('datas'));
    }
    public function search(Request $request)
    {
        if (!$request->cid) {
            toast('Customer not found!', 'error');
            return redirect()->back()->with('error', 'Agent not found')->withInput($request->all());
        }
        $datas = $this->report($request, Deposited::query());
        if ($datas->isEmpty()) {
            toast('Deposits not found!', 'error');
            return redirect()->back()->with('error', 'Agent not found')->withInput($request->all());
        }
        return view('report.index', compact('datas', 'request'));
    }

    public function datesearch(Request $request)
    {
       
        $datas = $this->report($request, Deposited::query());
        if ($datas->isEmpty()) {
            toast('Deposits not found!', 'error');
            return redirect()->back()->with('error', 'Agent not found')->withInput($request->all());
        }
        return view('report.date', compact('datas', 'request'));
    }
    public function agentsearch(Request $request)
    {
        $agents = Agents::with(['customers', 'customers.deposits'])->where('name', $request->agent)->first();
        if (!$agents) {
            $agents = Agents::with(['customers', 'customers.deposits'])->where('phone', $request->agent)->first();
        }
        if (!$agents) {
            toast('Agent not found!', 'error');
            return redirect()->back()->with('error', 'Agent not found')->withInput($request->all());
        }
        $TotalCollection = $agents->customers->map(function ($customer) {
            return $customer->deposits->sum('deposite_amount');
        })->sum();
        $earning = $agents->percentage / 100 * $TotalCollection;
        $agents->update(['amount' => $earning]);

        return view('report.agent', compact('request', 'agents', 'TotalCollection', 'earning'));
    }

    public function report($request, $class, $agent = null)
    {
        return $class
            ->when($request->cid, function ($query) use ($request) {
                $query->where('cid', $request->cid);
            })
            ->when($agent != null, function ($query) use ($agent) {
                $query->where('aid', $agent);
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
