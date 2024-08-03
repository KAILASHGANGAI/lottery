<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owner = Owner::first();
        return  view('settings.index', compact('owner'));
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
        $this->validateRequest($request);
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');

            // Generate a unique name for the file
            $fileName = uniqid('logo_') . '.' . $uploadedFile->getClientOriginalExtension();

            // Move the file to the public/photos directory
            $uploadedFile->move(public_path('photos/logo'), $fileName);

            // Set the photo attribute in the Customer model
            $request['logo'] = '/photos/logo/' . $fileName;
        }

        Owner::create($request->all());

        return redirect()->route('owners.create')->with('success', 'Owner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $data = $this->validateRequest($request);
        try {
            if ($request->hasFile('logo')) {
                $uploadedFile = $request->file('logo');
    
                // Generate a unique name for the file
                $fileName = uniqid('logo_') . '.' . $uploadedFile->getClientOriginalExtension();
    
                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos/logo'), $fileName);
           
                // Set the photo attribute in the Customer model
                $data['logo'] = '/photos/logo/' . $fileName;
            }
    
            $owner = Owner::find($id);
     
            $owner->update($data);


            return back()->with('success', 'Owner updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    protected function validateRequest(Request $request)
    {
       return $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'contact' => 'required|string|max:20',
            'owner_name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:20',
            'pan_number' => 'required|string|max:20',
            'address'=> 'nullable'
        ]);
    }
}
