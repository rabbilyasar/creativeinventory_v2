<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        @yield('title', 'Creative Inventory')
    </title>

    <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.png" rel="icon" type="image/png">
    <link href="img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/lib/bootstrap-sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/separate/vendor/sweet-alert-animations.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/main.css') }}">
    @stack('stylesheets')
</head>

<body class="with-side-menu">

    <header class="site-header">
        <div class="container-fluid">
            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
                <span>toggle menu</span>
            </button>
        
            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
                
            <div class="site-header-content">
                <div class="site-header-content-in">
                    <div class="site-header-shown">

                        <div class="dropdown user-menu">
                            <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{-- <img src="img/avatar-2-64.png" alt=""> --}}{{ucfirst(Auth::user()->name)}}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                    
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span
                                        class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                    <!--.site-header-shown-->


        <!--.container-fluid-->
    </header>
    <!--.site-header-->

    {{------------------ NAVBAR LIST -----------}}
    <div class="mobile-menu-left-overlay"></div>
    <nav class="side-menu">
        <ul class="side-menu-list">
            <li class="blue @yield('active-dashboard')">
                <a href="{{ route('home') }}">
                    <i class="font-icon font-icon-dashboard"></i>
                    <span class="lbl">Dashboard</span>
                </a>
            </li>
@if (Auth::user()->role == 1)
            {{--------------- REQUISTION FOR EMPLOYEE ------------}}
    <li class="red @yield('active-requisition')">
        <a href="{{ route('requisition.create') }}">
            <i class="font-icon fab fa-wpforms"></i>
            <span class="lbl">Make Requisition</span>
        </a>
    </li>
    @else
    {{------------------------ NAVBAR FOR ADMIN AND SUPER-ADMIN-------------------}}
    <li class="red with-sub">
        <span class="">
            <i class=" font-icon fab fa-wpforms @yield('active-requisition')"></i>
            &nbsp;<span class="lbl">Requisition</span>
        </span>
        <ul>
            <li>
                <a href="{{ route('requisition.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-list"></i>
                    <span class="lbl">&nbsp;<small>Requisition History</small> </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="green @yield('active-department')">
        <a href="{{ route('department.index') }}">
            <i class="font-icon fas fa-building"></i>
            <span class="lbl">Department</span>
        </a>
    </li>
    <li class="purple @yield('active-employee')">
        <a href="{{ route('employee.index') }}">
            <i class="font-icon fas fa-users"></i>
            <span class="lbl">Employee</span>
        </a>
    </li>
    <li class="red @yield('active-company')">
        <a href="{{ route('company.index') }}">
            <i class="font-icon glyphicon glyphicon-home"></i>
            <span class="lbl">Company</span>
        </a>
    </li>
    {{-- <li class="green @yield('active-warehouse')">
        <a href="{{ route('warehouse.index') }}">
            <i class="font-icon fas fa-warehouse"></i>
            &nbsp;<span class="lbl">Warehouse</span>
        </a>
    </li> --}}
    <li class="gold @yield('active-supplier')">
        <a href="{{route('supplier.index')}}">
            <i class="font-icon fas fa-truck"></i>
            <span class="lbl">Supplier</span>
        </a>
    </li>

    <li class="purple with-sub">
        <span class="">
            <i class=" font-icon fas fa-shopping-cart @yield('active-product')"></i>
            &nbsp;<span class="lbl">Product</span>
        </span>
        <ul>
            <li>
                <a href="{{ route('product.create') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-cart-plus"></i>
                    <span class="lbl">&nbsp;<small>Add Product</small> </span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('assign.create') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-sort-amount-up"></i>
                    <span class="lbl">&nbsp;<small>Assign Product</small> </span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('product.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-list"></i>
                    <span class="lbl">&nbsp;<small>Product List</small> </span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('product.trashView') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-trash"></i>
                    <span class="lbl">&nbsp;<small>Trash List</small> </span>
                </a>
            </li> --}}
        </ul>
    </li>

    <li class="red with-sub">
        <span class="">
            <i class="font-icon fas fa-store-alt @yield('active-purchase')"></i>
            <span class="lbl">Purchase</span>
        </span>
        <ul>
            <li>
                <a href="{{ route('purchase.create') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-plus-circle"></i>
                    <span class="lbl">&nbsp;<small>Add Purchase</small> </span>
                </a>
            </li>
            <li>
                <a href="{{ route('purchase.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-list"></i>
                    <span class="lbl">&nbsp;<small>Purchase List</small> </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="blue with-sub">
        <span class="">
            <i class="font-icon lbl fas fa-sync-alt @yield('active-assign_product')"></i>
            <span class="lbl">Assign Product</span>
        </span>
        <ul>
            <li>
                <a href="{{ route('assign.create') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-sync-alt"></i>
                    <span class="lbl">&nbsp;<small>Assign Product</small> </span>
                </a>
            </li>
            <li>
                <a href="{{ route('assign.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-list"></i>
                    <span class="lbl">&nbsp;<small>Assign Product List</small> </span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee_product.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-ellipsis-v"></i>
                    <span class="lbl">&nbsp;<small>Assigned Product To</small> </span>
                </a>
            </li>
        </ul>
    </li>

    {{-- <li class="blue @yield('active-company')">
        <a href="{{ route('assign.create') }}">
            <i class="font-icon lbl fas fa-sort-amount-up"></i>
            <span class="lbl">Assign Product</span>
        </a>
    </li> --}}
    <li class="green with-sub">
        <span class="">
            <i class="font-icon fas fa-boxes @yield('active-inventory')"></i>
            <span class="lbl">Inventory</span>
        </span>
        <ul>
            <li>
                <a href="{{ route('stock.index') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fas fa-list"></i>
                    <span class="lbl">&nbsp;<small>View Inventory</small> </span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('inventory.create') }}">
                    &nbsp;&nbsp;&nbsp; &nbsp;<i class="lbl fas fa-truck-loading"></i>
                    <span class="lbl">&nbsp;<small>Allocate Inventory</small> </span>
                </a>
            </li> --}}
        </ul>
    </li>
    {{-- <li class="blue @yield('active-role')">
        <a href="{{route('role.index')}}">
            <i class="font-icon fas fa-user-plus fa-lg"></i>
            <span class="lbl">Roles & permission</span>
        </a>
    </li> --}}
@endif



    {{-- <section>
        <ul class="side-menu-list">
            <li>
                <a href="#">
                    <i class="tag-color green"></i>
                    <span class="lbl">Website</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="tag-color grey-blue"></i>
                    <span class="lbl">Bugs/Errors</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="tag-color red"></i>
                    <span class="lbl">General Problem</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="tag-color pink"></i>
                    <span class="lbl">Questions</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="tag-color orange"></i>
                    <span class="lbl">Ideas</span>
                </a>
            </li>
        </ul>
    </section> --}}
</nav>
    <!--.side-menu-->

    <div class="page-content">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!--.container-fluid-->
    </div>
    <!--.page-content-->

    <script src="{{ asset('dashboard_assets/js/lib/jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="{{ asset('dashboard_assets/js/lib/popper/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/lib/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/plugins.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>

</body>

@yield('footer_scripts')
</html>
