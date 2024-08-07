<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Agents;
use App\Models\Deposite;
use App\Models\District;
use App\Models\Gaupalika;
use App\Models\Provision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
       # dd($request->all());
        try {
            DB::beginTransaction();
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
            if ($customer->refered_by) {
                $this->updateAgent($customer->refered_by);
            }
            DB::commit();
            toast('Customer created successfully!', 'success');
            return back()->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            toast('Some Thing Went Wrong. ', 'error');

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

        $temp_provision_id = $customer->temp_provision_id;
        $temp_district_id = $customer->temp_district_id;

        $districts = District::select(['id', 'districts_name'])->where('provision_id', $provision_id)->get();
        $gaupalikas = Gaupalika::select(['id', 'gaupalika_name'])->where('district_id', $district_id)->get();

        $tempdistricts = District::select(['id', 'districts_name'])->where('provision_id', $temp_provision_id)->get();
        $tempgaupalikas = Gaupalika::select(['id', 'gaupalika_name'])->where('district_id', $temp_district_id)->get();

        return view('customers.edit', compact(
            'customer', 'provisions', 'districts', 'gaupalikas', 'tempdistricts', 'tempgaupalikas'));
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

    public function updateAgent($aid){
        $agent = Agents::find($aid);
        $count = ($agent->customer_count == null) ? 0 : $agent->customer_count; 
        $agent->customer_count =  $count +1 ;
        $agent->save();
    }

    public function getcustomer(Request $request){
        $cid = $request->cid;

        $customer = Customer::query()
        ->select('id','cid', 'name', 'refered_by', 'lottery_amount')
        ->with(['agent:id,name'])
        ->where('cid', $cid)
        ->first();
        $due = $customer->lottery_amount ?? 0 ;
        $deposit = Deposite::where('cid', $cid)->latest()->get();
        if(count($deposit) > 0){
            $latestDeposite = Deposite::where('cid', $cid)->latest()->first();

            $due =$latestDeposite->due;
        }
        return response()->json([
            'customer'=>$customer,
            'fine'=>0, 
            'due'=> $due,
            'depositis'=> $deposit
        ]);

    }
}
