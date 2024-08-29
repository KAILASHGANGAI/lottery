<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Customer;
use App\Models\Deposited;
use Carbon\Carbon;
use Illuminate\Http\Request;
use NepaliDate\Facades\NepaliDate;

class DashboardController extends Controller
{
    public function index()
    {

        $todayNepaliDate = NepaliDate::create(now())->toBS();

        $thisMonth = $this->getCurrentNepaliMonth($todayNepaliDate);
        $thisYear = $this->getCurrentNepaliYear($todayNepaliDate);
        $datas = [
            'totalCustomer' => Customer::count(),
            'totalAgents' => Agents::count(),
            'todayCollection' => Deposited::whereDate('dod',  $todayNepaliDate)->sum('deposite_amount'),
            'thisMonthCollection' => Deposited::whereMonth('dod', $thisMonth)->sum('deposite_amount'),
            'thisYearCollection' => Deposited::whereYear('dod', $thisYear)->sum('deposite_amount'),
        ];
        
        return view('welcome', $datas);
    }
    public function getCurrentNepaliMonth($date)
    {
        return Carbon::parse($date)->format('n');
    }

    public function getCurrentNepaliYear($date)
    {
        return Carbon::parse($date)->format('Y');
    }
}
