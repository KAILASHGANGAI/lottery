<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\District;
use App\Models\Gaupalika;
use App\Models\Provision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customers = Customer::with(['provision:id,provision_name', 'district:id,districts_name', 'gaupalika:id,gaupalika_name'])->get();
        return view('/customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provisions = Provision::all();
        return view('/customers.add', compact('provisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            $customer = new Customer($request->all());
            // Handle image upload
            if ($request->hasFile('photo')) {
                $uploadedFile = $request->file('photo');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos'), $fileName);

                // Set the photo attribute in the Customer model
                $customer->photo = 'photos/' . $fileName;
            }

            $customer->save();
            toast('Customer created successfully!', 'success');

            return redirect()->route('customer.index')->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            toast($e->getMessage(), 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $provisions = Provision::all();
        $provision_id = $customer->provision_id;
        $district_id = $customer->district_id;

        $districts = District::select(['id', 'districts_name'])->where('provision_id', $provision_id)->get();
        $gaupalikas = Gaupalika::select(['id', 'gaupalika_name'])->where('district_id', $district_id)->get();

        return view('customers.edit', compact('customer', 'provisions', 'districts', 'gaupalikas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->all());


            if ($request->hasFile('photo')) {
                $uploadedFile = $request->file('photo');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos/customer'), $fileName);

                // Set the photo attribute in the Customer model
                $customer->photo = 'photos/customer/' . $fileName;
                $customer->save();
            }
            toast('Customer updated successfully!', 'success');

            return redirect()->route('customer.index')->with('success', 'Customer updated successfully!');
        } catch (\Exception $e) {
            toast($e->getMessage(), 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            toast('Customer deleted successfully!', 'success');

            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting customer: ' . $e->getMessage());
            toast('Error deleting customer. Please try again.', 'error');

            return redirect()->back()->with('error', 'Error deleting customer. Please try again.');
        }
    }

    public function getOptions($customerName)
    {
        // Fetch options based on the selected customer name
        $customer = Customer::select('id', 'name')->where('name', 'like', '%' . $customerName . '%')->get();

        if ($customer) {
            // Assume 'options' is a field in the Customer model
            $options = $customer;

            return response()->json(['options' => $options]);
        }

        return response()->json(['options' => []]);
    }
}
