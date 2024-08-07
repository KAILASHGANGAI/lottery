@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Settings</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">show</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form class="row"
                                action="{{ $owner->exists ? route('settings.update', $owner->id) : route('settings.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($owner->exists)
                                    @method('PATCH')
                                @endif

                                <div class="form-group col-sm-6">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name"
                                        value="{{ old('company_name', $owner->company_name) }}">
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="address">address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        value="{{ old('address', $owner->address) }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ old('email', $owner->email) }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="contact">Contact</label>
                                    <input type="text" name="contact" class="form-control" id="contact"
                                        value="{{ old('contact', $owner->contact) }}">
                                    @error('contact')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control" id="owner_name"
                                        value="{{ old('owner_name', $owner->owner_name) }}">
                                    @error('owner_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="reg_number">Registration Number</label>
                                    <input type="text" name="reg_number" class="form-control" id="reg_number"
                                        value="{{ old('reg_number', $owner->reg_number) }}">
                                    @error('reg_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="pan_number">PAN Number</label>
                                    <input type="text" name="pan_number" class="form-control" id="pan_number"
                                        value="{{ old('pan_number', $owner->pan_number) }}">
                                    @error('pan_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                                <div class="form-group col-sm-6">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <img src="{{ asset($owner->logo) }}" style="width: 50px" alt="" srcset="">
                                </div>

                                <div class="col-sm-6 pt-4">
                                    <button type="submit"
                                    class="btn btn-primary">{{ $owner->exists ? 'Update' : 'Create' }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Set Fine</h4>
                            <form class="row"
                            action="{{ @$fine->exists ? route('fine.update', $fine->id) : route('fine.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$fine->exists)
                                @method('PATCH')
                            @endif

                            <div class="form-group col-sm-6">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount"
                                    value="{{  @$fine->amount ?? old('amount') }}">
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="daysafter">After Days</label>
                                <input type="text" name="daysafter" class="form-control" id="daysafter"
                                    value="{{ @$fine->daysafter ?? old('daysafter') }}">
                                @error('daysafter')
                                    <div class="text-danger">{{ $message }}</div>   
                                @enderror
                            </div>
                           
                            <div class="col-sm-6 pt-4">
                                <button type="submit"
                                class="btn btn-primary">{{ @$fine->exists ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
