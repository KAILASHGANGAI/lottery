@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deposites</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Deposites</a></li>
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
                        <div class="row">

                            <div class="col-sm-4 p-4">
                                <h5> <strong>Name:</strong> {{ $deposites->name }}</h5>
                                <h6><strong>phone: </strong> {{ $deposites->phone }}</h6>
                                <span><strong>Provision:</strong> {{ $deposites->provision_id }}</span> <br>
                                <span><strong>District:</strong> {{ $deposites->district_id }}</span> <br>
                                <span><strong>Gaupalika:</strong> {{ $deposites->gaupalika_id }}</span> <br>
                                <span><strong>Ward:</strong> {{ $deposites->ward_no }}</span> <br>
                                <span><strong>Salary:</strong> {{ $deposites->salary }}</span> <br>
                                <span><strong>Gender:</strong> {{ $deposites->gender }}</span> <br>
                                <span><strong>Citizenship no:</strong> {{ $deposites->citizenship_no }}</span> <br>



                            </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <h2 class="card-title">Instalment details</h2> <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Instalment Amount</th>
                                        <th>Deposited By</th>
                                        <th>Deposited Date</th>
                                        <th>Deposited To</th>
                                        <th>Due</th>
                                        <th>Fine</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($staffs as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->name }} </td>
                                            <td>{{ $item->phone }}</td>
                                            <td> {{ $item->provision->provision_name }}</td>
                                            <td>{{ $item->district->districts_name }}</td>
                                            <td>{{ $item->gaupalika->gaupalika_name }}</td>
                                            <td>{{ $item->ward_no }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('staff.show', $item->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('staff.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('staff.delete', $item->id) }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach --}}




                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Instalment Amount</th>
                                        <th>Deposited By</th>
                                        <th>Deposited Date</th>
                                        <th>Deposited To</th>
                                        <th>Due</th>
                                        <th>Fine</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>
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
