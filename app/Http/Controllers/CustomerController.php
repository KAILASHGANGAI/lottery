<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Agents;
use App\Models\Deposite;
use App\Models\Deposited;
use App\Models\District;
use App\Models\fine;
use App\Models\Gaupalika;
use App\Models\Lottery;
use App\Models\Provision;
use Carbon\Carbon;
use Exception;
use NepaliDate\Facades\NepaliDate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request['temp_provision_id'] = $request->temp_provision_id ?? $request->provision_id;
        $request['temp_district_id'] = $request->temp_district_id ?? $request->district_id;
        $request['temp_gaupalika_id'] = $request->temp_gaupalika_id ?? $request->gaupalika_id;
        $request['temp_ward_no'] = $request->temp_ward_no ?? $request->ward_no;
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
            $lottert = Lottery::where('status', 1)->first();
            $customer->lottery_amount = $lottert->amount ?? 1000;

            $customer->save();
            if ($customer->refered_by) {
                $this->updateAgent($customer->refered_by);
            }
            DB::commit();
            toast('Customer created successfully!', 'success');
            return back()->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
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
            'customer',
            'provisions',
            'districts',
            'gaupalikas',
            'tempdistricts',
            'tempgaupalikas'
        ));
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
            }
            $lottert = Lottery::where('status', 1)->first();
            $customer->lottery_amount = $lottert->amount ?? 1000;
            $customer->save();
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

    public function updateAgent($aid)
    {
        $agent = Agents::find($aid);
        $count = ($agent->customer_count == null) ? 0 : $agent->customer_count;
        $agent->customer_count =  $count + 1;
        $agent->save();
    }

    // public function getcustomer(Request $request)
    // {
    //     $cid = $request->cid;
    //     $due = 0;
    //     $fineAmount = 0;
    //     $deposit = null;
    //     $day = 1;
    //     $customer = Customer::query()
    //         ->with(['agent:id,name'])
    //         ->where('cid', $cid)
    //         ->first();

    //     $toDayDate =  NepaliDate::create(now())->toBS();
    //     $currentmonth = $this->getCurrentNepaliMonth($toDayDate);
    //     $currentYear = $this->getCurrentNepaliYear($toDayDate);

    //     $deposited = Deposited::where('cid', $cid)->orderBy('dod', 'Desc')->get();
    //     $lottert = Lottery::where('status', 1)->first();
    //     $fine = fine::first();
    //     $lAmount = $customer->lottery_amount ?? $lottert->amount;

    //     if (count($deposited) > 0) {
    //         $latestDeposited = Deposited::where('cid', $cid)->orderBy('dod', 'Desc')->first();
    //         # dd($latestDeposited);
    //         $due = $latestDeposited->due;
    //         $lastpayedDate = $latestDeposited->dod;
    //         $lastPayedMonth = $this->getCurrentNepaliMonth($lastpayedDate);
    //         $lastPayedYear = $this->getCurrentNepaliYear($lastpayedDate);


    //         if ($lastPayedMonth == $currentmonth && $lastPayedYear == $currentYear) {
    //             return response()->json([
    //                 'message' => 'Already Payed for ' . $toDayDate,
    //             ]);
    //         }
    //     } else {
    //         // lottery Amount per month is 

    //         $regDate = $customer->reg_date;

    //         $regMon = $this->getCurrentNepaliMonth($regDate);
    //         $regYear = $this->getCurrentNepaliYear($regDate);

    //         if ($currentYear == $regYear) {
    //             $count = 1;
    //             $fineAmount = 0;
    //             for ($regMon; $regMon <= $currentmonth; $regMon++) {
    //                 $due = $count * $lAmount;
    //                 $fineAmount = ($regMon == $currentmonth) ? $fineAmount : $fineAmount + $fine->amount;
    //                 $dod = $currentYear . '-' . $regMon . '-' . $day;
    //                 $this->createDeposit($customer, $dod, $lAmount, $fineAmount, $due);
    //                 $count++;
    //             }
    //             $deposit = Deposite::where([
    //                 'cid' => $cid,
    //                 'status' => 0
    //             ])
    //                 ->orderBy('dod', 'Desc')
    //                 ->get();
    //         } else {
    //             if ($regYear < $currentYear) {
    //                 $count = 1;
    //                 for (; $regMon <= 12 && ($regYear < $currentYear || $regMon <= $currentmonth); $regMon++) {
    //                     $fineAmount = ($regMon == $currentmonth) ? $fineAmount : $fineAmount + $fine->amount;
    //                     $due = $count * $lAmount;
    //                     $dod = $regYear . '-' . str_pad($regMon, 2, '0', STR_PAD_LEFT) . '-' . $day;
    //                     $this->createDeposit(
    //                         $customer,
    //                         $dod,
    //                         $lAmount,
    //                         $fineAmount,
    //                         $due
    //                     );
    //                     // If the month is December, increment the year and reset the month to 1
    //                     if ($regMon == 12 && $regYear < $currentYear) {
    //                         $regYear++;
    //                         $regMon = 0; // Will be incremented to 1 at the beginning of the next loop
    //                     }
    //                     $count++;
    //                 }
    //                 $deposit = Deposite::where([
    //                     'cid' => $cid,
    //                     'status' => 0
    //                 ])
    //                     ->orderBy('dod', 'Desc')
    //                     ->get();
    //             } else {
    //                 return response()->json(['message' => 'Future Date has Not Arrived.']);
    //             }
    //         }
    //     }
    //     return response()->json([
    //         'customer' => $customer,
    //         'fine' => $fineAmount,
    //         'due' => $due + $fineAmount,
    //         'depositis' => $deposit
    //     ]);
    // }

    public function getcustomer(Request $request)
    {
        $cid = $request->cid;
        $day = 1;
        $deposit = null;
        $due = 0;

        $customer = Customer::with('agent:id,name')->where('cid', $cid)->first();
        if (!$customer) {
            return response()->json(['message' => 'No Customer Found With This CID']);
        }
        if (!$customer->reg_date) {
            return response()->json(['message' => 'Provide Regester Date To ' . $customer->name]);
        }
        if (!$customer->agent) {
            return response()->json(['message' => 'Give Agent name To ' . $customer->name]);
        }
        $toDayDate = NepaliDate::create(now())->toBS();
        $currentmonth = (int) $this->getCurrentNepaliMonth($toDayDate);
        $currentYear = (int) $this->getCurrentNepaliYear($toDayDate);

        $fine = fine::first();
        $deposited = Deposited::where('cid', $cid)->orderBy('created_at', 'Desc')->get();
        $lotteryAmount = $customer->lottery_amount ?? Lottery::where('status', 1)->value('amount');
        $fineAmount = 0;

        try {
            if ($deposited->isNotEmpty()) {
                $latestDeposited = $deposited->first();

                $lastPayedMonth = $this->getCurrentNepaliMonth($latestDeposited->dod);
                $lastPayedYear = $this->getCurrentNepaliYear($latestDeposited->dod);

                if ($lastPayedMonth == $currentmonth && $lastPayedYear == $currentYear) {
                    if ($latestDeposited->due != 0) {
                        return response()->json([
                            'customer' => $customer,
                            'fine' => $fineAmount,
                            'due' => $latestDeposited->due,
                            'depositis' => null
                        ]);
                    }
                    return response()->json([
                        'message' => 'Already Paid On ' . $toDayDate . '& Due Amount Is ' . $latestDeposited->due
                    ]);
                }

                $due = $latestDeposited->due; // Initialize with previous due amount
                $fineAmount = 0;

                // Loop through the months from the last deposited date to the current month of the current year
                for ($year = $lastPayedYear; $year <= $currentYear; $year++) {
                    $startMonth = ($year == $lastPayedYear) ? $lastPayedMonth + 1 : 1;
                    $endMonth = ($year == $currentYear) ? $currentmonth : 12;

                    for ($month = $startMonth; $month <= $endMonth; $month++) {

                        $due = $due + $lotteryAmount; // Accumulate the due amount
                        $dod = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $day;
                        # dd($dod);
                        $this->createDeposit(
                            $customer,
                            $dod,
                            $lotteryAmount,
                            $fineAmount,
                            $due
                        );

                        // Add fine if not the current month and current year
                        if ($year < $currentYear || $month < $currentmonth) {
                            $fineAmount += $fine->amount;
                        }
                    }
                }
            } else {
                $regMon = $this->getCurrentNepaliMonth($customer->reg_date);
                $regYear = $this->getCurrentNepaliYear($customer->reg_date);


                for ($count = 1; $regYear < $currentYear || ($regYear == $currentYear && $regMon <= $currentmonth); $regMon++, $count++) {
                    $dod = $regYear . '-' . str_pad($regMon, 2, '0', STR_PAD_LEFT) . '-' . $day;
                    $this->createDeposit(
                        $customer,
                        $dod,
                        $lotteryAmount,
                        $fineAmount,
                        $due = $count * $lotteryAmount
                    );

                    if ($regMon == 12) {
                        $regYear++;
                        $regMon = 0; // Resets the month to January (0 + 1 = 1)
                    }

                    if ($regYear < $currentYear || $regMon < $currentmonth) {
                        $fineAmount += $fine->amount;
                    }
                }
            }
            $deposit = Deposite::where(['cid' => $cid, 'status' => 0])->orderBy('dod', 'Desc')->get();

            return response()->json([
                'customer' => $customer,
                'fine' => $fineAmount,
                'due' => $due + $fineAmount,
                'depositis' => $deposit
            ]);
        } catch (Exception $th) {
            toast('Error while creating deposit. Please try again.', 'error');
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function getCurrentNepaliMonth($date)
    {
        return Carbon::parse($date)->format('n');
    }

    public function getCurrentNepaliYear($date)
    {
        return Carbon::parse($date)->format('Y');
    }

    public function monthDiff($date1, $date2)
    {
        $date1 = Carbon::parse($date1);
        $date2 = Carbon::parse($date2);
        $monthDiff = $date1->diffInMonths($date2);
        return $monthDiff;
    }

    public function createDeposit($customer, $dod, $lAmount, $fineAmount, $due)
    {

        return Deposite::updateOrCreate(
            [
                'cid' => $customer->cid,
                'dod' =>    $dod
            ],
            [
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_by' => @$customer->agent->name ?? null,
                'cid' => $customer->cid,
                'status' => 0,
                'deposite_amount' => $lAmount,
                'fine_amount' => $fineAmount,
                'due' => $due,
                'user_id' => Auth::id(),
                'dod' =>    $dod
            ]
        );
    }

    public function searchCustomer(Request $request)
    {

        $cid = $request->input('cid');

        // check if agent:name or number exists
        $exp = explode(':', $cid);
        if ($exp[0] == 'agent') {
            $agents = Agents::where('name', $exp[1])
                ->orWhere('phone', $exp[1])
                ->first();

            if (!$agents) {
                toast('Agent not found!', 'error');
                return redirect()->back()->with('error', 'Agent not found')->withInput($request->all());
            }
            $TotalCollection = $agents->customers->map(function ($customer) {
                return $customer->deposits->sum('deposite_amount');
            })->sum();
            $earning = $agents->percentage / 100 * $TotalCollection;
            $agents->update(['amount' => $earning]);
            return view('agents.show', compact('agents', 'TotalCollection', 'earning'));
        }

        $customer = Customer::where('cid', $cid)->first();
        if (!$customer) {
            toast('Customer not found!', 'error');
            return redirect()->back()->with('error', 'Customer not found')->withInput($request->all());
        }
        return view('customers.show', compact('customer'));
    }
}
