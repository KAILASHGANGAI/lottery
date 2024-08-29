<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\District;
use App\Models\Gaupalika;
use App\Models\Provision;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $staffs = Staff::with(['provision:id,provision_name', 'district:id,districts_name', 'gaupalika:id,gaupalika_name'])->get();
        return view('/staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provisions = Provision::all();
        return view('/staffs.add', compact('provisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        try {
            $Staff = new Staff($request->all());
            // Handle image upload
            if ($request->hasFile('photo')) {
                $uploadedFile = $request->file('photo');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos/staff'), $fileName);

                // Set the photo attribute in the Staff model
                $Staff->photo = 'photos/staff' . $fileName;
            }

            $Staff->save();
            toast('Staff created successfully!', 'success');

            return redirect()->route('staff.index')->with('success', 'Staff created successfully!');
        } catch (\Exception $e) {
            toast('Something went wrong' , 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        $provisions = Provision::all();
        $provision_id = $staff->provision_id;
        $district_id = $staff->district_id;

        $districts = District::select(['id', 'districts_name'])->where('provision_id', $provision_id)->get();
        $gaupalikas = Gaupalika::select(['id', 'gaupalika_name'])->where('district_id', $district_id)->get();

        return view('staffs.edit', compact('staff', 'provisions', 'districts', 'gaupalikas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        try {

            $staff->update($request->all());


            if ($request->hasFile('photo')) {
                $uploadedFile = $request->file('photo');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos'), $fileName);

                // Set the photo attribute in the staff model
                $staff->photo = 'photos/' . $fileName;
                $staff->save();
            }
            toast('staff updated successfully!', 'success');

            return redirect()->route('staff.index')->with('success', 'staff updated successfully!');
        } catch (\Exception $e) {
            toast('Something went wrong' , 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        try {
            $staff->delete();
            toast('staff deleted successfully!', 'success');

            return redirect()->route('staff.index')->with('success', 'staff deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting staff: ' . $e->getMessage());
            toast('Something went Wrong !!', 'error');

            return redirect()->back()->with('error', 'Error deleting staff. Please try again.');
        }
    }
}
