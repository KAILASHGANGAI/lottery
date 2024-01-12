<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Sisnovate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="/" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <i class="nav-icon ion ion-person-add"></i>
                        <p>
                            Customers
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Customers</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('staff.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Staff
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('staff.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('staff.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New staff</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Deposite
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('deposite.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Deposite</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('deposite.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Deposited Amount</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Lottery Items
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('items.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('items.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Items</p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
