@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Create New Deposites</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Deposites</a></li>
                        <li class="breadcrumb-item active">add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        </div>
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <form id="quickForm" method="post" action="{{ route('deposite.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Customer Id Number</label>
                                    <input type="text" id="customer_id" name="customer_id" class="form-control"
                                        value="{{ old('customer_id') }}" placeholder="Enter Id">
                                    @error('customer_id')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" id="customerName" name="customer_name" class="form-control"
                                        value="{{ old('customer_name') }}" placeholder="Enter Full name">
                                    <div id="options-container"></div>

                                    @error('customer_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposite Amount :</label>
                                    <input type="number" name="deposite_amount" class="form-control"
                                        value="{{ old('deposite_amount') }}" placeholder="deposited Amount.">
                                    @error('deposite_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Due Amount :</label>
                                    <input type="number" name="due" class="form-control" value="{{ old('due') }}"
                                        placeholder="Due Amount.">
                                    @error('due')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Fine Amount:</label>
                                    <input type="text" name="fine_amount" class="form-control"
                                        value="{{ old('fine_amount') }}" placeholder="fine Amount.">
                                    @error('fine_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposited By:</label>
                                    <input type="text" name="customer_by" class="form-control"
                                        value="{{ old('customer_by') }}" placeholder="deposited by">
                                    @error('customer_by')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposite Date:</label>
                                    <input type="date" name="dod" class="form-control" value="{{ old('dod') }}"
                                        placeholder="dod">
                                    @error('dod')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
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
            var customerNameInput = $('#customerName');
            var optionsContainer = $('#options-container');
            var customer_id = $('#customer_id');

            customerNameInput.on('input', function() {
                var customerName = $(this).val();

                if (customerName.length >= 3) {
                    $.ajax({
                        type: 'GET',
                        url: '/get-options/' + customerName,
                        success: function(data) {
                            optionsContainer.empty();

                            // Append fetched options under the input field
                            if (data.options.length > 0) {
                                $.each(data.options, function(index, option) {
                                    var optionDiv = $('<div>', {
                                        class: 'option',
                                        text: option.name +
                                            "-" + option.id
                                    });

                                    optionDiv.on('click', function() {
                                        // Set the value of the input field on option click
                                        customerNameInput.val(option.name);
                                        customer_id.val(option.id)
                                        optionsContainer
                                            .empty(); // Hide options after selection
                                    });

                                    optionsContainer.append(optionDiv);
                                });
                            } else {
                                optionsContainer.append('<p>No options available.</p>');
                            }
                        }
                    });
                }
                // Make an Ajax request to fetch options based on the input field value

            });
        });
    </script>
@endsection
