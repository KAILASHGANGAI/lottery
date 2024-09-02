@extends('../layouts.app')

@section('title', 'Agents Details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Agents</h2>
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
                <div class="col-8">
                    <div class="card p-2">
                        <div>
                            <p><strong>Name:</strong> {{ $agents->name }} |
                                <strong>Phone No.:</strong> {{ $agents->phone }} |  <br>
                                <strong>percentage:</strong> {{ $agents->percentage ?? 0 }} % <br>
                                <strong>Amount:</strong> Rs. {{ $agents->amount ?? 0 }}  <br>
                                <strong>Date:</strong> {{ $agents->reg_date }}</strong>
                                                      
                            </p>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-4">
                    <div class="card p-2">
                        <span class="text-danger">Total Collection: Rs. {{ $TotalCollection }}</span> |
                        <span class="text-success">Earning Amount: Rs. {{ $earning }}</span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th> CustomerID</th>
                                    <th>Contact No</th>
                                    <th>Address</th>
                                    <td>TotalDeposited</td>
                                   <th>Remarks</th>
                                  

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agents->customers as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ ucfirst($item->name) }} </td>
                                        <td>{{ $item->cid }} </td>
                                        <td>{{ $item->phone }}</td>
                                        <td> {{ ucfirst($item->provision->provision_name).", ". 
                                         ucfirst($item->district->districts_name).", ". 
                                         ucfirst($item->gaupalika->gaupalika_name) ."-".
                                         $item->ward_no }}</>
                                        <td>Rs. {{ $item->deposits->sum('deposite_amount') }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach




                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th> CustomerID</th>
                                    <th>Contact No</th>
                                    <th>Address</th>
                                    <td>Total Deposited</td>
                                    <th>Remarks</th>
                                </tr>   
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
