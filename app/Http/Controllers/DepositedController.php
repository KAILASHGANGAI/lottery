<?php

namespace App\Http\Controllers;

use App\Models\Deposited;
use App\Http\Requests\StoreDepositedRequest;
use App\Http\Requests\UpdateDepositedRequest;
use App\Models\Deposite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NepaliDate\Facades\NepaliDate;


class DepositedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates = $request->validate([
            'customer_id' => 'required|exists:customers,id',
        
            'cid' => 'required',
            'deposite_amount' => 'required|numeric|min:0',
            'fine_amount' => 'numeric|min:0',
            'due' => 'numeric|min:0',
       

        ]);
        try {
            DB::beginTransaction();
     
            $validates['user_id'] = Auth::id();
            $validates['dod'] = NepaliDate::create(now())->toBS();

           
            Deposited::create($validates);
            if ($request->depositMonth) {
                Deposite::whereIn('id',$request->depositMonth)->update(['status'=>1]);
            }
            DB::commit();
            toast('Payment created successfully!', 'success');

            return back()->with('success', 'deposite created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            toast($e->getMessage(), 'error');

            return back()->withInput()->with('error', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposited $deposited)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposited $deposited)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositedRequest $request, Deposited $deposited)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposited $deposited)
    {
        //
    }
}
