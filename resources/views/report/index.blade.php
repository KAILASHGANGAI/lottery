@extends('../layouts.app')
@section('title', 'Reports By Customer')

<style>
    .table td,
    .table th {
        padding: 6px !important;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1>Reports By Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button type="submit" id="printButton" onclick="printBill()" class="btn btn-success">
                                🖨
                            </button>
                        </li>
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
                        <div class="card-header pb-0 ">

                            <div class="card-tools">
                                <form action="{{ route('searchreport') }}" method="post">
                                    @csrf
                                    <div class="input-group input-group-sm" style="width: ;">
                                        <input type="text" value="{{ $request->cid ?? old('cid') }}" name="cid"
                                            class="form-control float-right" placeholder="Search By Customer Id" required>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body" id="billContent">
                            <table id="" class="table table-bordered table-">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>CustomerID</th>
                                        <th>Customer</th>
                                        <th>Agent</th>
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
                                        <td colspan="6" class="text-center">No Record Found</td>
                                    @endif
                                </tbody>

                                <tfoot>
                                    </tr>
                                    <td colspan="4" class="text-center">Total</td>

                                    <td colspan="2">Rs.{{ $datas->sum('deposite_amount') ." /-" }}</td>

                                    </tr>
                                </tfoot>
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
<script>
    function printBill() {
        // Hide the print button before printing
        document.getElementById('printButton').style.display = 'none';

        // Get the content of the specific div
        var divContents = document.getElementById('billContent').innerHTML;

        // Save the current page content
        var originalContents = document.body.innerHTML;

        // Replace the body content with the div content
        document.body.innerHTML = divContents;

        // Trigger the browser's print functionality
        window.print();

        // Restore the original page content
        document.body.innerHTML = originalContents;

        // Show the print button after printing is done
        document.getElementById('printButton').style.display = 'block';
    }
</script>
