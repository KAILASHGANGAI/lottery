@extends('../layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Create New Agents</h2>
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
                    <form id="quickForm" method="post" action="{{ route('agents.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h1 class="card-title text-primary">Personal Details</h1> <br>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Full name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Percentage</label>
                                    <input type="number" name="percentage" class="form-control" placeholder="percentage Number"
                                        value="{{ old('percentage') }}">
                                    @error('percentage')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Reg. Date</label>
                                    <input type="text" class="form-control" name="reg_date" value="{{ old('reg_date') }}" id="nepali-datepicker" placeholder="Select Nepali
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
                                text: option.districts_name
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
                                text: option.gaupalika_name
                            }));
                        });
                    }
                }
            });
        }
    </script>
@endsection
