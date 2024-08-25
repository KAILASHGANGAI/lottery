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
                        <div class="container mt-3">
                            <div class="row">
                                <!-- Photo Section -->
                                @if ($customer->photo == null || $customer->photo == '')
                                    
                                @else
                                    <div class="col-sm-2">
                                        <img src="{{ asset($customer->photo) }}" class="img-fluid rounded"
                                            alt="Customer Photo">
                                    </div>
                                @endif



                                <!-- Personal & Contact Information -->
                                <div class="col-sm-5">
                                    <h6><strong>Name:</strong> {{ $customer->name }}</h6>
                                    <p><strong>Phone:</strong> {{ $customer->phone }} |
                                        <strong>Gender:</strong> {{ $customer->gender }} |
                                        <strong>Citizenship No:</strong> {{ $customer->citizenship_no }}
                                    </p>
                                    <p><strong>Occupation:</strong> {{ $customer->occupation }} |
                                        <strong>Work Location:</strong> {{ $customer->wlocation }}
                                    </p>
                                    <p><strong>Father:</strong> {{ $customer->father_name }} |
                                        <strong>Mother:</strong> {{ $customer->mother_name }} |
                                        <strong>Spouse:</strong> {{ $customer->hf_name }}
                                    </p>
                                    <p><strong>Members:</strong> {{ $customer->no_of_members }} |
                                        <strong>Referred By:</strong> {{ @$customer->agent->name }}
                                    </p>
                                </div>

                                <!-- Address Information (Permanent and Temporary) -->
                                <div class="col-sm-5">
                                    <h6><strong>Address (Permanent):</strong></h6>
                                    <p>{{ ucfirst($customer->provision->provision_name) }},
                                        {{ ucfirst($customer->district->districts_name) }},
                                        {{ ucfirst($customer->gaupalika->gaupalika_name) }},
                                        Ward {{ $customer->ward_no }}</p>

                                    <h6><strong>Address (Temporary):</strong></h6>
                                    <p>{{ ucfirst(@$customer->tempprovision->provision_name) }},
                                        {{ ucfirst(@$customer->tempdistrict->districts_name) }},
                                        {{ ucfirst(@$customer->tempgaupalika->gaupalika_name) }},
                                        Ward {{ @$customer->temp_ward_no }}</p>

                                    <p><strong>Lottery Amount:</strong> {{ $customer->lottery_amount }} |
                                        <strong>Salary:</strong> {{ $customer->salary }}
                                    </p>
                                    <p><strong>Joined:</strong> {{ $customer->created_at->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <h2 class="card-title">Instalment details</h2> <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>CID</th>
                                        <th>Deposited</th>
                                        <th>Fine </th>
                                        <th>Due</th>

                                        <th>Deposit Date</th>
                                        <th>Created At</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customer->deposits as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->customer->name }} </td>
                                            <td>{{ $item->cid }}</td>
                                            <td>Rs. {{ $item->deposite_amount }}</td>
                                            <td>Rs.{{ $item->fine_amount }}</td>
                                            <td>Rs. {{ $item->due }}</td>

                                            <td>{{ $item->dod }}</td>
                                            <td>{{ $item->created_at }}</td>

                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td>Rs. {{ $customer->deposits->sum('deposite_amount') }}/-</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>CID</th>
                                        <th>Deposited </th>
                                        <th>Fine </th>
                                        <th>Due</th>

                                        <th>Deposit Date</th>
                                        <th>Created At</th>

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
