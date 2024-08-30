@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Deposites</h5>
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
                                        <th>S.N</th>
                                        <th>CustomerName</th>
                                        <th>CustomerId</th>
                                        <th>Deposite </th>
                                        <th>Fine </th>
                                        <th>Due</th>

                                        <th>date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposites as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->customer->name }} </td>
                                            <td>{{ $item->cid }} </td>
                                            <td>{{ $item->deposite_amount }}</td>
                                            <td>{{ $item->fine_amount }}</td>
                                            <td>{{ $item->due }}</td>
                                            <td>{{ $item->dod }}</td>

                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('deposited.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('deposited.bill', $item->id) }}">
                                                    <i class="fas fa-print">
                                                    </i>
                                                    
                                                </a>
                                                {{-- @php
                                                    $todayDate = \Carbon\Carbon::now()->toDateString();
                                                @endphp
                                                    @if ($item->created_at->toDateString() === $todayDate)
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('deposite.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('deposite.destroy', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <a class="btn btn-danger btn-sm" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                                @else 
                                                {{ '-' }}
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.N</th>
                                        <th>CustomerName</th>
                                        <th>CustomerId</th>
                                        <th>Deposite </th>
                                        <th>Fine </th>
                                        <th>Due</th>

                                        <th>date</th>
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
