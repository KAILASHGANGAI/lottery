@extends('../layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Deposit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Deposit</a></li>
                        <li class="breadcrumb-item active">add</li>
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
                    <form id="quickForm" method="post" action="{{ route('deposite.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Customer Id Number</label>
                                    <input type="text" name="customer_id" class="form-control" placeholder="Enter Id">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        placeholder="Enter Full name">
                                </div>


                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposite Amount :</label>
                                    <input type="number" name="deposite_amount" class="form-control"
                                        placeholder="deposited Amount.">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Fine Amount:</label>
                                    <input type="text" name="fine_amount" class="form-control"
                                        placeholder="fine Amount.">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposited By:</label>
                                    <input type="text" name="customer_by" class="form-control"
                                        placeholder="deposited by">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="exampleInputPassword1">Deposite Date:</label>
                                    <input type="date" name="dod" class="form-control" placeholder="dod">
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
    <!-- /.content -->
@endsection
