<?php

namespace App\Http\Controllers;

use App\Models\Deposite;
use App\Http\Requests\StoreDepositeRequest;
use App\Http\Requests\UpdateDepositeRequest;
use Illuminate\Support\Facades\Log;

class DepositeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposites = Deposite::all();
        return view('deposite.index', compact('deposites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/deposite.add', compact('provisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepositeRequest $request)
    {
        try {
            $deposite = new Deposite($request->all());


            $deposite->save();
            toast('Payment created successfully!', 'success');

            return redirect()->route('deposite.index')->with('success', 'deposite created successfully!');
        } catch (\Exception $e) {
            toast($e->getMessage(), 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposite $deposite)
    {
        return view('deposite.show', compact('deposite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposite $deposite)
    {
        return view('deposite.edit', compact('deposite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepositeRequest $request, Deposite $deposite)
    {
        try {

            $deposite->update($request->all());
            toast('deposite updated successfully!', 'success');

            return redirect()->route('deposite.index')->with('success', 'deposite updated successfully!');
        } catch (\Exception $e) {
            toast($e->getMessage(), 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposite $deposite)
    {
        try {
            $deposite->delete();
            toast('Deposite deleted successfully!', 'success');

            return redirect()->route('deposite.index')->with('success', 'deposite deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting deposite: ' . $e->getMessage());
            toast('Error deleting deposite. Please try again.', 'error');
            return redirect()->back()->with('error', 'Error deleting deposite. Please try again.');
        }
    }
}
