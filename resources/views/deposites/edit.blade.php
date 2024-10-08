@extends('../layouts.app')
@section('title', 'Update Deposite')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Update Deposite</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('deposite.index')}}" class="btn btn-secondary">List</a>
                        </li>
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
                    <form id="quickForm" method="post" action="{{ route('deposited.update', $deposited->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Customer Id Number</label>
                                    <input type="text" name="cid" class="form-control"
                                        value="{{ $deposited->cid ?? old('cid') }}" disabled placeholder="Enter Id">
                                    @error('cid')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ $deposited->customer->name ?? old('customer_name') }}"
                                        placeholder="Enter Full name" disabled>
                                    @error('customer_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Deposite Amount :</label>
                                    <input type="number" name="deposite_amount" class="form-control"
                                        value="{{ $deposited->deposite_amount ?? old('deposite_amount') }}"
                                        placeholder="deposited Amount.">
                                    @error('deposite_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Due Amount :</label>
                                    <input type="number" name="due" class="form-control"
                                        value="{{ $deposited->due ?? old('due') }}" placeholder="Due Amount.">
                                    @error('due')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Fine Amount:</label>
                                    <input type="text" name="fine_amount" class="form-control"
                                        value="{{ $deposited->fine_amount ?? old('fine_amount') }}"
                                        placeholder="fine Amount.">
                                    @error('fine_amount')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposited By:</label>
                                    <input type="text" name="customer_by" class="form-control"
                                        value="{{ $deposited->customer->agent->name ?? old('customer_by') }}"
                                        placeholder="deposited by" disabled>
                                    @error('customer_by')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposite Date:</label>
                                    <input type="date" name="dod" class="form-control"
                                        value="{{ $deposited->dod ?? old('dod') }}" placeholder="dod" disabled>
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
