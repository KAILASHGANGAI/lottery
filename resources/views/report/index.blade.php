@extends('../layouts.app')

<style>
    .table td, .table th {
        padding: 6px !important;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid card p-2">
            <div class="row mb-2">
                <div class="col-sm-8">
                   <form action="{{ route('searchreport') }}" method="post">
                    @csrf
                    <div class="form row ">
                        <div class="col-sm-2">
                            
                            <h5>Reports</h5>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="from_date">CID</label>
                            <input type="text" class="form-control" id="from_date" name="cid">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="from_date">From:</label>
                            <input type="text" class="form-control" name="from_date" value="{{ old('from_date') }}" id="nepali-datepicker" placeholder="Select Nepali" />
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="to_date">To:</label>
                            <input type="text" class="form-control" name="to_date" value="{{ old('to_date') }}" id="nepali-datepicker2" placeholder="Select Nepali" />
                        </div>
                        <div class="form-group col-sm-1">
                        <button type="submit" class="btn btn-info mt-4">Submit</button>
                        </div>
                    </div>
                   </form>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><button  class="btn btn-primary">Print</button>
                        </li> --}}
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="/" class="btn btn-danger">Cancle</a>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1"  class="table table-bordered table-">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Cid</th>
                                        <th>Customer</th>
                                        <th>Agent By</th>
                                        <th>DepositeAmount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($datas) > 0)
                                    @foreach ($datas as $key => $report)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $report->cid }}</td>
                                        <td>{{ $report->customer->name }}</td>
                                        <td>{{ $report->customer->agent->name }}</td>
                                        <td>{{ $report->deposite_amount }}</td>
                                        <td>{{ $report->dod }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <td colspan="7" class="text-center">No Record Found</td>
                                    @endif
                                </tbody>
                            </table>
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
