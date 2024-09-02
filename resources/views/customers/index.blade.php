@extends('../layouts.app')
@section('title', 'Customers List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Customers</h5>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th> CustomerID</th>
                                        <th>Agent</th>
                                        <th>Contact No</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ ucfirst($item->name) }} </td>
                                            <td>{{ $item->cid }} </td>
                                            <td>{{ $item->agent->name?? '-' }} </td>
                                            <td>{{ $item->phone }}</td>
                                            <td> {{ ucfirst($item->provision->provision_name) . ", " . 
                                            ucfirst($item->district->districts_name) . ", " . 
                                            ucfirst($item->gaupalika->gaupalika_name) . "-" . 
                                            $item->ward_no }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('customer.show', $item->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('customer.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('customer.destroy', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <a class="btn btn-danger btn-sm" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach




                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th> CustomerID</th>
                                        <th>Agent </th>

                                        <th>Contact No</th>
                                        <th>Address</th>
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
