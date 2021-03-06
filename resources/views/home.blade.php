@extends('layouts.dashboardapp')

@section('title', 'Dashboard')
@section('active-dashboard', 'opened')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/separate/pages/widgets.min.css') }}">
@endpush

@section('content')
{{------------------------ DASHBOARD ----------------------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>
    </div>
</div>

{{------------------ FOR EMPLOYEE --------------------------}}
@if (Auth::user()->role == 1)
    <div class="col-md-12 text-center bg-secondary p-2 text-white"> <strong>LIST OF ALL REQUISITION</strong></div>
    <div class="row pb-5">
        <div class="col-md-12">
            <table class="table table-bordered" id="emp_table">
                <thead class="">
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Requested Product</th>
                    <th>Requested Quantity</th>
                    <th>Requisition Status</th>
                    {{-- <th>User Name</th> --}}
                    {{-- <th>User Designation</th> --}}
                    {{-- <th>Action</th> --}}
                </tr>
                </thead>
                <tbody>
                @forelse($requisition_by_id as $requisition)
                <tr>
                    {{-- {{print_r($requisition)}} --}}
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $requisition->created_at->format('d-M-y') }}</td>
                    <td>
                        @if ($requisition->product->category_status == 2)
                            {{strtoupper($requisition->product->name)}}
                        @else
                            {{ $requisition->product->name }}</td>
                        @endif
                    <td>{{ $requisition->quantity }}</td>
                    {{-- <td>{{ $requisition->user->name }}</td> --}}
                    <td>
                        @if ($requisition->status == 0)
                            <button class="btn btn-warning form-control">Pending</button>
                        @endif
                        @if ($requisition->status == 1)
                            <button class="btn btn-success form-control">Approved</button>
                        @endif
                        @if ($requisition->status == 2)
                            <button class="btn btn-danger form-control">Rejected</button>
                        @endif
                        @if ($requisition->status == 3)
                            <button class="btn btn-info form-control">Forwarded</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="text-center text-danger">
                    <td colspan="7">No Requisition Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif


{{----------------------- STATS ---------------------------}}
@if (Auth::user()->role !== 1)  
    <div class="row">
        <div class="col-sm-3">
            <section class="widget widget-simple-sm">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon fas fas fa-list color-green"></i>
                </div>
                <div class="widget-simple-sm-bottom">
                    <a href="{{ route('requisition.index') }}">{{ $requisition_count }} {{ ($requisition_count <= 1) ? 'Requisition' : str_plural('Requisition') }}</a>
                </div>
            </section><!--.widget-simple-sm-->
        </div>
        <div class="col-sm-3">
            <section class="widget widget-simple-sm">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon fas fa-store-alt color-red"></i>
                </div>
                <div class="widget-simple-sm-bottom">
                    <a href="{{ route('purchase.index') }}">{{ $purchase_count }} {{ ($purchase_count <= 1) ? 'Purchase' : str_plural('Purchase') }}</a>
                </div>
            </section><!--.widget-simple-sm-->
        </div>
        <div class="col-sm-3">
            <section class="widget widget-simple-sm">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon fas fa-shopping-cart color-purple"></i>
                </div>
                <div class="widget-simple-sm-bottom">
                    <a href="{{ route('product.index') }}">{{ $product_count }} {{ ($product_count <= 1) ? 'Product' : str_plural('Product') }}</a>
                </div>
            </section><!--.widget-simple-sm-->
        </div>
        <div class="col-sm-3">
            <section class="widget widget-simple-sm">
                <div class="widget-simple-sm-icon">
                    <i class="font-icon fas fa-user-tie color-blue"></i>
                </div>
                <div class="widget-simple-sm-bottom">
                    <a href="{{ route('supplier.index') }}">{{ $user_count }} {{ ($user_count <= 1) ? 'User' : str_plural('User') }}</a>
                </div>
            </section><!--.widget-simple-sm-->
        </div>
    </div>
@endif

{{------------------------ FOR ADMIN ------------------------}}
@if (Auth::user()->role == 2)
    <div class="col-md-12 text-center bg-secondary p-2 text-white"> <strong>LIST OF ALL REQUISITION</strong></div>
    @if(session('status'))
        <div class="alert alert-info alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('status') }}
            {{-- dfkjdfkj --}}
        </div>
    @endif
    <div class="row pb-5">
        <div class="col-md-12">
            <table class="table table-bordered" id="admin_table">
                <thead class="">
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Requested Product</th>
                    <th>Requested Quantity</th>
                    <th>User Name</th>
                    <th>Note</th>
                    {{-- <th>User Designation</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($requisitions as $requisition)
                        @if ($requisition->status === 3||$requisition->status == 0)
                            <tr>
                                <td>{{ $loop->index+1}}</td>
                                <td>{{ $requisition->created_at->format('d-M-y') }}</td>
                                @if ($requisition->product->category_status == 1)
                                    <td>{{strtoupper($requisition->product->name)}} #{{($requisition->product->supplier->name)}}</td>
                                @else
                                    <td>{{strtoupper($requisition->product->name)}} #{{($requisition->product->supplier->name)}}</td>
                                @endif
                                <td>{{ $requisition->quantity }}</td>
                                <td>{{ $requisition->user->name }}</td>
                                <td><small>{{ $requisition->note }}</small></td>
                                <td>
                                    @if ($requisition->product->category_status == 1)                                   
                                        <div class="btn-group btn-group-sm">
                                            @if (App\Stock::where('product_id', $requisition->product_id)->exists())
                                                @if (App\Stock::where('product_id', $requisition->product_id)->sum('quantity') >= $requisition->quantity)
                                                    <a href="{{url('requisition/approve')}}/{{$requisition->id}}" class="btn btn-primary-outline">Approve</a>
                                                    @if ($requisition->status !== 3 )
                                                    <a href="{{url('requisition/forward')}}/{{$requisition->id}}" class="btn btn-info-outline">Forward</a>
                                                        
                                                    @endif  
                                                @else
                                                    <button class="btn btn-danger mr-2">Not enough product</button>
                                                @endif
                                            @else
                                                <button class="btn btn-danger mr-2">Not in stock</button>
                                            @endif
                                            <a href="{{url('requisition/reject')}}/{{$requisition->id}}" class="btn btn-danger-outline">Reject</a>
                                        </div>
                                    @else
                                        <a href="{{route('requisition.show',$requisition->id)}}" class="btn btn-secondary-outline form-control">Assign</a>
                                    @endif
                                </td>
                            </tr>   
                        @endif
                    @empty
                    <tr class="text-center text-danger">
                        <td colspan="7">No Requisition Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif

{{----------------------- FOR SUPER-ADMIN ------------------------}}
@if (Auth::user()->role == 3) 
    @if(session('status'))
        <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12 text-center bg-secondary p-2 text-white"> <strong>LIST OF ALL REQUISITION</strong></div>
    <div class="row pb-5">
        <div class="col-md-12">
            <table class="table table-bordered" id="sup_table">
                <thead class="">
                <tr>
                    <th>#</th>
                    <th>Create at</th>
                    <th>Requested Product</th>
                    <th>Requested Quantity</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($requisitions as $requisition)
                <tr>
                    @if ($requisition->status == 3)
                    {{-- {{print_r($requisition)}} --}}
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $requisition->created_at->format('d-M-y') }}</td>
                    <td>{{strtoupper($requisition->product->name)}} #{{($requisition->product->supplier->name)}}</td>
                    <td>{{ $requisition->quantity }}</td>
                    <td>{{ $requisition->user->name }}</td>
                    <td>
                        @if ($requisition->product->category_status == 1)  
                            <div class="btn-group btn-group-sm">
                                <a href="{{url('requisition/approve')}}/{{$requisition->id}}" class="btn btn-primary-outline">Approve</a>
                                <a href="{{url('requisition/reject')}}/{{$requisition->id}}" class="btn btn-danger-outline">Reject</a>
                            </div>
                        @else
                            <a href="{{route('requisition.show',$requisition->id)}}" class="btn btn-secondary-outline form-control">Assign</a>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr class="text-center text-danger">
                    <td colspan="7">No Requisition Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif

{{---------------------- CHARTS -----------------------}}
@if (Auth::user()->role !== 1)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Charts
                </div>
                <div class="card-body">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

                    {!! $TestChart->container() !!}
                    {!! $TestChart->script() !!}
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){
            $('#emp_table, #admin_table, #sup_table, #admin_table1').DataTable();
        });
    </script>
@endsection
