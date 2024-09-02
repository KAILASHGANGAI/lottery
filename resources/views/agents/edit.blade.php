@extends('../layouts.app')
@section('title', 'Update Agents' )

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Update Agents</h2>
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

            <!-- /.row -->
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  
                    <form id="quickForm" method="post" action="{{ route('agents.update', $agents->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ $agents->name ?? old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ $agents->phone ?? old('phone') }}">
                                    @error('phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Percentage</label>
                                    <input type="number" name="percentage" class="form-control" placeholder="percentage Number"
                                        value="{{ $agents->percentage ?? old('percentage') }}">
                                    @error('percentage')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Reg. Date</label>
                                    <input type="text" class="form-control" name="reg_date" value="{{ $agents->reg_date ?? old('reg_date') }}" id="nepali-datepicker" placeholder="Select Nepali
                                    Date"/>
                                    @error('reg_date')
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

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Assume you have an AJAX function to fetch options
        $('#getDistrictsByProvision').on('change', fetchDistricts);
        $('#districtOptions').on('change', fetchGaupalika);

        function fetchDistricts(e) {
            var value = e.target.value;
            var selectedDistrictId = $('#districtOptions').val(); // Get the currently selected district ID

            $.ajax({
                url: "/get-districts/" + value,
                method: "GET",
                success: function(response) {
                    $('#districtOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: option.districts_name
                            });

                            // Set the selected attribute if the district ID matches the selectedDistrictId
                            if (selectedDistrictId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#districtOptions').append(optionElement);
                        });
                    }
                }
            });
        }

        function fetchGaupalika(e) {
            var value = e.target.value;
            var selectedGaupalikaId = $('#gaupalikaOptions').val(); // Get the currently selected Gaupalika ID

            $.ajax({
                url: "/get-gaupalaika/" + value,
                method: "GET",
                success: function(response) {
                    $('#gaupalikaOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: option.gaupalika_name
                            });

                            // Set the selected attribute if the Gaupalika ID matches the selectedGaupalikaId
                            if (selectedGaupalikaId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#gaupalikaOptions').append(optionElement);
                        });
                    }
                }
            });
        }
    </script>
@endsection
