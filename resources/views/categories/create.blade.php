@extends('../layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Categories</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Categories</a></li>
                        <li class="breadcrumb-item active">List</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <h1>Create Category</h1>

                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Category Name:</label> <br>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        required>
                                    @error('name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Create Category</button>
                            </form>
                        </div>
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
