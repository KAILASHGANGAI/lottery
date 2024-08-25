<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Orbit</span>
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
                <li class="nav-item menu-open">
                    <a href="{{ route('pos') }}" class="nav-link bg-success">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            POS
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('deposite.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Deposite
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('deposite.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Deposite</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('deposite.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Deposited</p>
                            </a>
                        </li>

                    </ul>
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
                    <a href="{{ route('agents.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-magnet"></i>
                        <p>
                            Agents
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('agents.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List agents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agents.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New agents</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.report') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.report') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agent.report') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Agent report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('date.report') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>By Date report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('staff.index') }}" class="nav-link">
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
                        <i class="nav-icon fas fa-tags "></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new Product</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new Product</p>
                            </a>
                        </li>

                    </ul>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cart-plus"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Orders</p>
                            </a>
                        </li>


                    </ul>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Settings</p>
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
