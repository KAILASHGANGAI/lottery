@extends('../layouts.app')
@section('title', 'Add Customers')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Create New Customers</h5>
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
                    <form id="quickForm" method="post" action="{{ route('customer.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Customer Id</label>
                                    <input type="text" name="cid" class="form-control"
                                        placeholder="Enter customer Id" value="{{ old('cid') }}">
                                    @error('cid')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Reg. Date</label>
                                    <input type="text" class="form-control" value="{{ old('reg_date') }}" name="reg_date" id="nepali-datepicker"
                                        placeholder="Select Nepali
                                    Date" />
                                    @error('reg_date')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Gender</label>
                                        <select class="form-control select2" name="gender" style="width: 100%;"
                                            value="{{ old('gender') }}">
                                            <option {{ old('gender') == '' ? 'selected' : '' }} selected="selected">Select Gender </option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="others" {{ old('gender') == 'others' ? 'selected' : '' }}>Others</option>
                                        

                                        </select>
                                        @error('gender')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Reg. Fee:</label>
                                    <input type="number" name="reg_fee" class="form-control" placeholder="Amount."
                                        value="{{ old('reg_fee') }}">
                                    @error('reg_fee')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">CitizenShip Number:</label>
                                    <input type="text" class="form-control" name="citizenship_no"
                                        value="{{ old('citizenship_no') }}" />
                                    @error('citizenship_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Photo:</label> <br>
                                    <input type="file" name="photo" />
                                    @error('photo')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>
                            <hr>
                            <h1 class="card-title text-success">Permanent Address Details</h1> <br>

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Provision</label>
                                        <select id="getDistrictsByProvision" name="provision_id"
                                            class="form-control select2" style="width: 100%;"
                                            value="{{ old('provision_id') }}">
                                            <option selected="selected">Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ ucfirst($item->provision_name) }}</option>
                                            @endforeach

                                        </select>
                                        @error('provision_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>District</label>
                                        <select id="districtOptions" name="district_id" class="form-control select2"
                                            style="width: 100%;" value="{{ old('district_id') }}">
                                            <option selected="selected">Select District</option>

                                        </select>
                                        @error('district_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Gaupalika</label>
                                        <select id="gaupalikaOptions" name="gaupalika_id" class="form-control select2"
                                            value="{{ old('gaupalika_id') }}" style="width: 100%;">
                                            <option selected="selected">Select Gaupalika</option>

                                        </select>
                                        @error('gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    <input id="ward_no" type="number" name="ward_no" class="form-control"
                                        placeholder="Ward No." value="{{ old('ward_no') }}">
                                    @error('ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h1 class="card-title text-success">Temporary Address Details
                                <input type="checkbox" name="sameaspermanent" id="same_as_permanent">
                            </h1> Same As Above <br>

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Provision</label>
                                        <select id="tempgetDistrictsByProvision" name="temp_provision_id"
                                            class="form-control select2" style="width: 100%;"
                                            value="{{ old('temp_provision_id') }}">
                                            <option value="" selected="selected">Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ ucfirst($item->provision_name) }}</option>
                                            @endforeach

                                        </select>
                                        @error('temp_provision_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>District</label>
                                        <select id="tempdistrictOptions" name="temp_district_id"
                                            class="form-control select2" style="width: 100%;"
                                            value="{{ old('temp_district_id') }}">
                                            <option value="" selected="selected">Select District</option>

                                        </select>
                                        @error('temp_district_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Gaupalika</label>
                                        <select id="tempgaupalikaOptions" name="temp_gaupalika_id"
                                            class="form-control select2" value="{{ old('temp_gaupalika_id') }}"
                                            style="width: 100%;">
                                            <option value="" selected="selected">Select Gaupalika</option>

                                        </select>
                                        @error('temp_gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    
                                    <input id="temp_ward_no" type="number" name="temp_ward_no" class="form-control"
                                        placeholder="Ward No." value="{{ old('temp_ward_no') }}">
                                    @error('temp_ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            {{-- <hr>
                            <h1 class="card-title text-success">Employment Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control"
                                        placeholder="Occupation" value="{{ old('occupation') }}">
                                    @error('occupation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Monthly Salary</label>
                                    <input type="text" name="salary" name="text" class="form-control"
                                        placeholder="monthly salary in NRS" value="{{ old('salary') }}">
                                    @error('salary')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Working Location</label>
                                    <input type="text" name="wlocation" class="form-control"
                                        placeholder="working location" value="{{ old('wlocation') }}">
                                    @error('wlocation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div> --}}
                            <hr>
                            <h1 class="card-title text-info">Noninee Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full name:</label>
                                    <input type="text" name="nominee_holder_name" class="form-control"
                                        placeholder="Enter Full name" value="{{ old('nominee_holder_name') }}">
                                    @error('nominee_holder_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Relation:</label>
                                    <input type="text" name="nominee_relation" class="form-control"
                                        placeholder="Relation" value="{{ old('nominee_relation') }}">
                                    @error('nominee_relation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1"> Phone:</label>
                                    <input type="text" name="nominee_phone" class="form-control"
                                        placeholder="nominee_phone" value="{{ old('nominee_phone') }}">
                                    @error('nominee_phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                            </div>
                            <hr>
                            <h1 class="card-title text-info">Family Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Father name:</label>
                                    <input type="text" name="father_name" class="form-control"
                                        placeholder="Enter Full name" value="{{ old('father_name') }}">
                                    @error('father_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Full Mother Name:</label>
                                    <input type="text" name="mother_name" class="form-control"
                                        placeholder="Mother name" value="{{ old('mother_name') }}">
                                    @error('mother_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Husband / Wifename:</label>
                                    <input type="text" name="hf_name" class="form-control"
                                        placeholder="husband or wife name" value="{{ old('hf_name') }}">
                                    @error('hf_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">No.Of family members:</label>
                                    <input type="text" name="no_of_members" class="form-control"
                                        placeholder="No.Of family members" value="{{ old('no_of_members') }}">
                                    @error('no_of_members')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Refered By:</label>
                                    <input type="text" id="refered_name" name="refered_name" class="form-control"
                                        placeholder="refered By name" value="{{ old('refered_name') }}">

                                    <input type="hidden" id="refered_by" value="{{ old('refered_by') }}" name="refered_by" required>

                                    <div id="options-container"></div>

                                    @error('refered_by')
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
            $.ajax({
                url: "/get-districts/" + value,
                method: "GET",
                success: function(response) {

                    $('#districtOptions').html("");
                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            $('#districtOptions').append($('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.districts_name)
                            }));
                            $('#tempdistrictOptions').append($('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.districts_name)
                            }));
                        });
                    }
                }
            });
        }

        function fetchGaupalika(e) {
            var value = e.target.value;
            $.ajax({
                url: "/get-gaupalaika/" + value,
                method: "GET",
                success: function(response) {

                    $('#gaupalikaOptions').html("");
                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {

                            $('#gaupalikaOptions').append($('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.gaupalika_name)
                            }));
                            $('#tempgaupalikaOptions').append($('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.gaupalika_name)
                            }));
                        });
                    }
                }
            });
        }

        function capitalizeFirstLetter(string) {
            return `${string.charAt(0).toUpperCase()}${string.slice(1)}`;
        }


        $(document).ready(function() {
            $('#same_as_permanent').change(function() {

                if (this.checked) {
                    $('#tempgetDistrictsByProvision').val($('#getDistrictsByProvision').val()).trigger(
                        'change');
                    $('#tempdistrictOptions').val($('#districtOptions').val()).trigger('change');
                    $('#tempgaupalikaOptions').val($('#gaupalikaOptions').val()).trigger('change');
                    $('#temp_ward_no').val($('#ward_no').val());
                } else {
                    $('#tempgetDistrictsByProvision').val('').trigger('change');
                    $('#tempdistrictOptions').val('').trigger('change');
                    $('#tempgaupalikaOptions').val('').trigger('change');
                    $('#temp_ward_no').val('');
                }
            });
        });

        $(document).ready(function() {
            var customerNameInput = $('#refered_name');
            var optionsContainer = $('#options-container');
            var customer_id = $('#refered_by');

            customerNameInput.on('input', function() {
                var customerName = $(this).val();

                if (customerName.length >= 3) {
                    $.ajax({
                        type: 'GET',
                        url: '/get-agents/' + customerName,
                        success: function(data) {
                            optionsContainer.empty();

                            // Append fetched options under the input field
                            if (data.options.length > 0) {
                                $.each(data.options, function(index, option) {
                                    var optionDiv = $('<div>', {
                                        class: 'option',
                                        text: option.name

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
    <style>
        #options-container {
            position: relative;
            margin-top: -1px;
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
@endsection
