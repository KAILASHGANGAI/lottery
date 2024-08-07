@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Customers</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="/" class="btn btn-secondary">Cancle</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ asset($customer->photo) }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-sm-4 p-4">
                                <h5> <strong>Name:</strong> {{ $customer->name }}</h5>
                                <h6><strong>phone: </strong> {{ $customer->phone }}</h6>
                                <span><strong>Per. Provision:</strong> {{ ucfirst($customer->provision->provision_name) }}</span> <br>
                                <span><strong>Per. District:</strong> {{ ucfirst($customer->district->districts_name) }}</span> <br>
                                <span><strong>Per. Gaupalika:</strong> {{ ucfirst($customer->gaupalika->gaupalika_name) }}</span> <br>
                                <span><strong>Per. Ward:</strong> {{ $customer->ward_no }}</span> <br>

                                <span><strong>Temp. Provision:</strong> {{ ucfirst(@$customer->tempprovision->provision_name) }}</span> <br>
                                <span><strong>Temp. District:</strong> {{ ucfirst(@$customer->tempdistrict->districts_name) }}</span> <br>
                                <span><strong>Temp. Gaupalika:</strong> {{ ucfirst(@$customer->tempgaupalika->gaupalika_name) }}</span> <br>
                                <span><strong>Temp. Ward:</strong> {{ @$customer->temp_ward_no }}</span> <br>

                                <span><strong>Lottery Amount:</strong> {{ $customer->lottery_amount }}</span> <br>
                                <span><strong>Salary:</strong> {{ $customer->salary }}</span> <br>



                            </div>
                            <div class="col-sm-4 p-4">
                                <span><strong>Gender:</strong> {{ $customer->gender }}</span> <br>
                                <span><strong>Citizenship no:</strong> {{ $customer->citizenship_no }}</span> <br>
                                <span><strong>Occupation:</strong> {{ $customer->occupation }}</span> <br>
                                <span><strong>Working Location:</strong> {{ $customer->wlocation }}</span> <br>
                                <span><strong>Father Name:</strong> {{ $customer->father_name }}</span> <br>
                                <span><strong>Mother Name:</strong> {{ $customer->mother_name }}</span> <br>
                                <span><strong>Husband / Wife Name:</strong> {{ $customer->hf_name }}</span> <br>
                                <span><strong>Number of Members :</strong> {{ $customer->no_of_members }}</span> <br>
                                <span><strong>Refered By:</strong> {{ @$customer->agent->name }}</span> <br>
                                <span><strong>Joining date:</strong> {{ $customer->created_at->format('Y-m-d') }}</span>
                                <br>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <h2 class="card-title">Instalment details</h2> <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>CID</th>
                                        <th>Deposite </th>
                                        <th>Fine </th>
                                        <th>Due</th>
                                        <th>DepositedBy</th>
                                        <th>Deposit Date</th>
                                        <th>Created At</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer->deposits as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->customer_name }} </td>
                                            <td>{{ $item->cid }}</td>
                                            <td> {{ $item->deposite_amount }}</td>
                                            <td>{{ $item->fine_amount}}</td>
                                            <td>{{ $item->due}}</td>
                                            <td>{{ $item->dod }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            
                                        </tr>
                                    @endforeach




                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Instalment Amount</th>
                                        <th>Deposited By</th>
                                        <th>Deposited Date</th>
                                        <th>Deposited To</th>
                                        <th>Due</th>
                                        <th>Fine</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
