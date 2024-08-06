@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Update Customers</h5>
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
                    <form id="quickForm" method="post" action="{{ route('customer.update', $customer->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ $customer->name ?? old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Customer Id</label>
                                    <input type="text" name="cid" class="form-control"
                                        placeholder="Enter customer Id" value="{{ $customer->cid ?? old('cid') }}">
                                    @error('cid')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ $customer->phone ?? old('phone') }}">
                                    @error('phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                              
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Gender</label>
                                        <select class="form-control select2" name="gender" style="width: 100%;"
                                            value="{{ $customer->gender ?? old('gender') }}">
                                            <option selected="selected">Select Gender </option>
                                            <option {{ isset($customer) && $customer->gender == 'male' ? 'selected' : '' }}
                                                value="male">Male</option>
                                            <option
                                                {{ isset($customer) && $customer->gender == 'female' ? 'selected' : '' }}
                                                value=female>Female</option>
                                            <option
                                                {{ isset($customer) && $customer->gender == 'others' ? 'selected' : '' }}
                                                value="others">Others</option>

                                        </select>
                                        @error('gender')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Amount Of Lottery:</label>
                                    <input type="number" name="lottery_amount" class="form-control" placeholder="Amount."
                                        value="{{ $customer->lottery_amount ?? old('lottery_amount') }}">
                                    @error('lottery_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">CitizenShip Number:</label>
                                    <input type="text" class="form-control" name="citizenship_no"
                                        value="{{ $customer->citizenship_no ?? old('citizenship_no') }}" />
                                    @error('citizenship_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Photo:</label> <br>
                                    <input type="file" name="photo" />
                                    <img style="width: 50px " src="{{ asset($customer->photo) }}" alt="">
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
                                            <option value="" selected disabled>Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($customer) && $customer->provision_id == $item->id ? 'selected' : '' }}>
                                                    {{ ucfirst($item->provision_name) }}
                                                </option>
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
                                            style="width: 100%;"
                                            value="{{ $customer->district_id ?? old('district_id') }}">
                                            <option value="" selected disabled>Select District</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($customer) && $customer->district_id == $item->id ? 'selected' : '' }}>
                                                    {{ ucfirst($item->districts_name) }}
                                                </option>
                                            @endforeach

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
                                            value="{{ $customer->gaupalika_id ?? old('gaupalika_id') }}"
                                            style="width: 100%;">
                                            <option value="" selected disabled>Select Gaupalika</option>
                                            @foreach ($gaupalikas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($customer) && $customer->gaupalika_id == $item->id ? 'selected' : '' }}>
                                                    {{ ucfirst($item->gaupalika_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    <input id="ward_no" type="number" name="ward_no" class="form-control" placeholder="Ward No."
                                        value="{{ $customer->ward_no ?? old('ward_no') }}">
                                    @error('ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h1 class="card-title text-success">Temporary Address Details 
                            </h1>  <br>

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Provision</label>
                                        <select id="tempgetDistrictsByProvision" name="temp_provision_id"
                                            class="form-control select2" style="width: 100%;"
                                            value="{{ old('temp_provision_id') }}">
                                            <option selected="selected">Select Provisions</option>
                                            @foreach ($provisions as $item)
                                                <option {{ isset($customer) && $customer->temp_provision_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
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
                                    
                                        <select id="tempdistrictOptions" name="temp_district_id" class="form-control select2"
                                        style="width: 100%;"
                                        value="{{ $customer->district_id ?? old('district_id') }}">
                                        <option value="" selected disabled>Select District</option>
                                        @foreach ($tempdistricts as $item)
                                            <option value="{{ $item->id }}"
                                                {{ isset($customer) && $customer->temp_district_id == $item->id ? 'selected' : '' }}>
                                                {{ ucfirst($item->districts_name) }}
                                            </option>
                                        @endforeach

                                    </select>
                                        @error('temp_district_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="">
                                        <label>Gaupalika</label>
                                        <select id="tempgaupalikaOptions" name="temp_gaupalika_id" class="form-control select2"
                                            value="{{ old('temp_gaupalika_id') }}" style="width: 100%;">
                                            <option value="" selected disabled>Select Gaupalika</option>
                                            @foreach ($tempgaupalikas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($customer) && $customer->temp_gaupalika_id == $item->id ? 'selected' : '' }}>
                                                    {{ ucfirst($item->gaupalika_name) }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('temp_gaupalika_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Ward No.:</label>
                                    <input  id="temp_ward_no" type="number" name="temp_ward_no" class="form-control" placeholder="Ward No."
                                        value="{{ $customer->temp_ward_no ?? old('temp_ward_no') }}">
                                    @error('temp_ward_no')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <h1 class="card-title text-info">Noninee Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full  name:</label>
                                    <input type="text" name="nominee_holder_name" class="form-control"
                                        placeholder="Enter Full name" value="{{ $customer->nominee_holder_name ?? old('nominee_holder_name') }}">
                                    @error('nominee_holder_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Relation:</label>
                                    <input type="text" name="nominee_relation" class="form-control"
                                        placeholder="Relation" value="{{ $customer->nominee_relation ?? old('nominee_relation') }}">
                                    @error('nominee_relation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1"> Phone:</label>
                                    <input type="text" name="nominee_phone" class="form-control"
                                        placeholder="nominee_phone" value="{{ $customer->nominee_phone ?? old('nominee_phone') }}">
                                    @error('nominee_phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                          

                            </div>
                            {{-- <hr>
                            <h1 class="card-title text-success">Employment Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control"
                                        placeholder="Occupation"
                                        value="{{ $customer->occupation ?? old('occupation') }}">
                                    @error('occupation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Monthly Salary</label>
                                    <input type="text" name="salary" name="text" class="form-control"
                                        placeholder="monthly salary in NRS"
                                        value="{{ $customer->salary ?? old('salary') }}">
                                    @error('salary')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Working Location</label>
                                    <input type="text" name="wlocation" class="form-control"
                                        placeholder="working location"
                                        value="{{ $customer->wlocation ?? old('wlocation') }}">
                                    @error('wlocation')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div> --}}
                            <hr>
                            <h1 class="card-title text-info">Family Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Father name:</label>
                                    <input type="text" name="father_name" class="form-control"
                                        placeholder="Enter Full name"
                                        value="{{ $customer->father_name ?? old('father_name') }}">
                                    @error('father_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Full Mother Name:</label>
                                    <input type="text" name="mother_name" class="form-control"
                                        placeholder="Mother name"
                                        value="{{ $customer->mother_name ?? old('mother_name') }}">
                                    @error('mother_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>



                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Husband / Wifename:</label>
                                    <input type="text" name="hf_name" class="form-control"
                                        placeholder="husband or wife name"
                                        value="{{ $customer->hf_name ?? old('hf_name') }}">
                                    @error('hf_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">No.Of family members:</label>
                                    <input type="text" name="no_of_members" class="form-control"
                                        placeholder="No.Of family members"
                                        value="{{ $customer->no_of_members ?? old('no_of_members') }}">
                                    @error('no_of_members')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Refered By:</label>
                                    <input type="text" name="refered_by" class="form-control"
                                        placeholder="refered By name"
                                        value="{{ $customer->refered_by ?? old('refered_by') }}">
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

        $('#tempgetDistrictsByProvision').on('change', tempfetchDistricts);
        $('#tempdistrictOptions').on('change', tempfetchGaupalika); 

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
                                text: capitalizeFirstLetter(option.districts_name)
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
                                text: capitalizeFirstLetter(option.gaupalika_name)
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

        function tempfetchDistricts(e) {
            var value = e.target.value;
            var selectedDistrictId = $('#tempdistrictOptions').val(); // Get the currently selected district ID

            $.ajax({
                url: "/get-districts/" + value,
                method: "GET",
                success: function(response) {
                    $('#tempdistrictOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.districts_name)
                            });

                            // Set the selected attribute if the district ID matches the selectedDistrictId
                            if (selectedDistrictId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#tempdistrictOptions').append(optionElement);
                        });
                    }
                }
            });
        }

        function tempfetchGaupalika(e) {
            var value = e.target.value;
            var selectedGaupalikaId = $('#tempgaupalikaOptions').val(); // Get the currently selected Gaupalika ID

            $.ajax({
                url: "/get-gaupalaika/" + value,
                method: "GET",
                success: function(response) {
                    $('#tempgaupalikaOptions').html(""); // Clear existing options

                    if ($.trim(response)) {
                        // Assuming response is an array of options
                        $.each(response, function(index, option) {
                            var optionElement = $('<option>', {
                                value: option.id,
                                text: capitalizeFirstLetter(option.gaupalika_name)
                            });

                            // Set the selected attribute if the Gaupalika ID matches the selectedGaupalikaId
                            if (selectedGaupalikaId == option.id) {
                                optionElement.attr('selected', 'selected');
                            }

                            $('#tempgaupalikaOptions').append(optionElement);
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
                $('#tempgetDistrictsByProvision').val($('#getDistrictsByProvision').val()).trigger('change');
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
    </script>
@endsection
