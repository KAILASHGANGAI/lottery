@extends('../layouts.app')

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
                    <h1>Reports By Agent</h1>
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
                        <div class="card-header pb-0">

                            <div class="card-tools">
                                <form action="{{ route('agentsearchreport') }}" method="post">
                                    @csrf
                                    <div class="input-group input-group-sm" style="width: ;">
                                        <input type="text" value="{{ $request->agent ?? old('agent') }}" name="agent"
                                            class="form-control float-right" placeholder="Search  Agent Name" required>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body" id="billContent">
                            <table class="table table-bordered table-">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>CustomerID</th>
                                        <th>Customer</th>
                                        <th>Agent</th>
                                        <th>TotalDepositeAmount</th>
                                        <th>Reg.Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (!empty($agents))
                                        @foreach ($agents->customers as $key => $customers)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $customers->cid }}</td>
                                                <td>{{ $customers->name }}</td>
                                                <td>{{ $customers->agent->name }}</td>
                                                <td>Rs. {{ $customers->deposits->sum('deposite_amount') }}</td>
                                                <td>{{ $customers->reg_date }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="6" class="text-center">No Record Found</td>
                                    @endif
                                </tbody>

                                <tfoot class="text-center">
                                    <tr>

                                        <td colspan="3">Total Collection</td>
                                        <td colspan="3">Rs. {{ $TotalCollection ?? '0' . ' /-' }}</td>

                                    </tr>
                                    <tr>

                                        <td colspan="3">Total Earning</td>
                                        <td colspan="3">Rs. {{ $earning ?? '0' . ' /-' }} of {{ $agents->percentage ?? 0 . '%' }}
                                        </td>

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
