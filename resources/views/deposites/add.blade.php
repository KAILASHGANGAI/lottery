@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Create New Deposites</h5>
                    {{ now()->toBS() }}
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
        </div>
        <form id="quickForm" method="post" action="{{ route('deposited.store') }}">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                   
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputEmail1">Customer Id Number</label>
                                    <input type="text" id="cid" name="cid" class="form-control"
                                        value="{{ old('cid') }}" placeholder="Enter Id">
                                    @error('cid')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Deposite Amount :</label>
                                    <input type="number" id="deposite_amount" name="deposite_amount" class="form-control"
                                        value="{{ old('deposite_amount') }}" placeholder="deposited Amount.">
                                    @error('deposite_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Deposite Date:</label>
                                    <input type="text" class="form-control" value="{{ old('dod') }}" name="dod"
                                        id="nepali-datepicker"
                                        placeholder="Select Nepali
                                Date" />

                                    @error('dod')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div> --}}
                              


                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Due Amount :</label>
                                    <input type="number" id="due" name="due" class="form-control"
                                        value="{{ old('due') }}" placeholder="Due Amount.">
                                    @error('due')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Fine Amount:</label>
                                    <input type="number" id="fine" name="fine_amount" class="form-control"
                                        value="{{ old('fine_amount') }}" placeholder="fine Amount.">
                                    @error('fine_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="hidden" id="customer_id" name="customer_id"
                                        value="{{ old('customer_id') }}">
                                    <input type="text" id="customerName" name="customer_name" class="form-control"
                                        value="{{ old('customer_name') }}" placeholder="Enter Full name">

                                    @error('customer_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Refered By:</label>
                                    <input type="text" id="customer_by" name="customer_by" class="form-control"
                                        value="{{ old('customer_by') }}" placeholder="Refered by">
                                    @error('customer_by')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                  
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="DataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" id="checkAll"></th>
                                            <th>S.N</th>
                                            <th>CustomerName</th>
                                            <th>CustomerId</th>
                                            <th>Status</th>
                                            <th>Deposite </th>
                                            <th>Fine </th>
                                            <th>Due</th>
                                            <th>Deposit Month</th>
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!--/.col (right) -->
            
        </div>
    </form>
        <!-- /.container-fluid -->
    </section>
@endsection
<style>
    #options-container {
        position: relative;
        margin-top: -1px;
        /* Align with the input field */
        border: 1px solid #ccc;
        border-top: none;
        max-height: 150px;
        overflow-y: auto;
    }

    .option {
        padding: 8px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f0f0f0;
    }
</style>
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cid').on('blur', function() {
                let customerId = $(this).val();

                $.ajax({
                    url: '/get-customer', // Replace with your actual endpoint
                    type: 'POST',
                    data: {
                        cid: customerId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.message) {
                            alert(response.message);
                           
                        }
                        $('#customerName').val(response.customer.name)
                        $('#customer_id').val(response.customer.id)
                        $('#customer_by').val(response.customer.agent.name)
                        $('#due').val(response.due)
                        $('#fine').val(response.fine)

                        $('#DataTable tbody').empty();

                        // Loop through the response data and append rows to the table
                        $.each(response.depositis, function(index, item) {
                            let date = new Date(item.created_at);
                            let formattedDate = date.toLocaleString();
                            let status = item.status == 0 ? "UnPaied" : "Paied";

                            $('#DataTable tbody').append(
                                '<tr>' +
                                '<td><input type="checkbox" name="depositMonth[]" class="checkbox" value="'+item.id+'" /></td>' +
                                '<td>' + ++index + '</td>' +
                                '<td>' + item.customer_name + '</td>' +
                                '<td>' + item.cid + '</td>' +
                                '<td>' + status + '</td>' +
                                '<td>' + item.deposite_amount + '</td>' +
                                '<td>' + item.fine_amount + '</td>' +
                                '<td>' + item.due + '</td>' +
                                '<td>' + item.dod + '</td>' +
                                '<td>' + formattedDate + '</td>' +
                                '</tr>'
                            );
                        });
                    },
                    error: function(xhr) {
                        // Handle any errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });


        $(document).ready(function() {
            $('#deposite_amount').on('blur', function() {
                calculateNetDeposit();
            });

            function calculateNetDeposit() {
                let depositedAmount = $('#deposite_amount').val();

                let left = $('#due').val();
                if (depositedAmount > 0) {
                    let due = left - depositedAmount;
                    $('#due').val(due);
                }

            }
        });

        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('.checkbox').prop('checked', this.checked);
            });

            $('.checkbox').click(function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });
        });
    </script>
@endsection
