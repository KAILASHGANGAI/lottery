@extends('../layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create New Item/Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Item/Product</a></li>
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
                <form id="quickForm" method="post" action="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Full name">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="exampleInputEmail1">Product Code</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Product code">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="exampleInputPassword1">Product price</label>
                                <input type="text" name="password" class="form-control"
                                    id="exampleInputPassword1" placeholder="Phone Number">
                            </div>

                            <div class="col-md-4 form-group">
                                <div class="">
                                    <label>Product cateory</label>
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 form-group">
                                <label for="exampleInputPassword1">Image</label> <br>
                                <input type="file" name="file" />
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