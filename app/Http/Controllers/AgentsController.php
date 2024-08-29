<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Http\Requests\StoreAgentsRequest;
use App\Http\Requests\UpdateAgentsRequest;
use Exception;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agents::all();
        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentsRequest $request)
    {
        try {
            $agents =  new Agents($request->all());
            $agents->save();
            toast('Agent created successfully!', 'success');
            return back()->with('success', 'Added successfully');
        } catch (Exception $th) {
            toast('Failed To Create. !!', 'error');
            return back()->withInput()->with('error', 'Failed To Create. !!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agents = Agents::with(['customers'])->where('id', $id)->first();
        $TotalCollection = $agents->customers->map(function ($customer) {
            return $customer->deposits->sum('deposite_amount');
        })->sum();
        $earning = $agents->percentage / 100 * $TotalCollection;
        $agents->update(['amount' => $earning]);
        return view('agents.show', compact('agents', 'TotalCollection', 'earning'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agents = Agents::find($id);
        return view('agents.edit', compact('agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentsRequest $request,  $id)
    {
        $agents = Agents::find($id);
        $agents->update($request->all());
        toast('Agents updated successfully!', 'success');

        return redirect()->route('agents.index')->with('success', 'agents updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Agents::find($id)->delete();
        toast('agents deleted successfully!', 'success');

        return redirect()->route('agents.index')->with('success', 'agents deleted successfully!');
    }

    public function search($search)
    {
        // Fetch options based on the selected customer name
        $customer = Agents::select('id', 'name')->where('name', 'like', '%' . $search . '%')->get();

        if ($customer) {
            // Assume 'options' is a field in the Customer model
            $options = $customer;

            return response()->json(['options' => $options]);
        }

        return response()->json(['options' => []]);
    }
}
