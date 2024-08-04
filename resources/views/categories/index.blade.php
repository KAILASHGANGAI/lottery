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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N</th>

                                        <th>Category Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>

                                            <td>{{ $item->name }}</td>


                                            <td>

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('categories.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('categories.destroy', $item->id) }}" method="POST"
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
                                        <th>S.N</th>

                                        <th>Category Name</th>
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
