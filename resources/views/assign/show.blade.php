@extends('layouts.dashboardapp')

@section('title', 'REQUISITION DETAILS')

@section('content')
{{---------------- BREADCRUMB  ---------------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">DASHBOARD</a>
            <span class="breadcrumb-item active">REQUISITION DETAILS</span>
        </nav>
    </div>
</div>
<div class="card col-md-12">
    <div class="card-head p-2 bg-dark text-white text-center">
        <h3>{{strtoupper($requisition->product->name)}}</h3>
        <small>{{strtoupper($requisition->created_at->diffForHumans())}}</small>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-body mt-3">
                <h2 class="text-center"> <strong>REQUISITION DETAILS</strong> </h2>
                <strong>Requested by: </strong>
                <span>{{$requisition->user->name}}</span>
                {{-- <span>{{$requisition->user->company->company_name}}</span> --}}
                <br><br>
                <strong>Requested product: </strong>
                <span>{{$requisition->product->name}}</span>
                <br><br>
                <strong>Note: </strong>
                <p>{{$requisition->note}}</p>
                <br>
                <small class="error">Requested time: {{strtoupper($requisition->created_at)}}</small>
                {{-- @foreach ($assigns as $assign)
                    <div class="bg-danger text-center text-white p-1">
                        <h4><strong>{{strtoupper($requisition->product->company->company_name) }}/{{strtoupper($assign->product->name)}}-{{$requisition->product->unique_id}}</strong> is currently assigned to <strong>{{$assign->user->name}}</strong></h4>
                    </div>
                @endforeach --}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body mt-3">
                <h2 class="text-center"> <strong>PRODUCT DETAILS</strong> </h2>
                <table class="table">
                    <thead>
                    </thead>
                    <tbody>
                            <div class="card">
                                    <div class="card-body">
                                    {{-------------- SUCCESS MESSAGES -------------}}
                                        @if(session('success'))
                                            <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if(session('status'))
                                            <div class="alert alert-danger alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    {{-------------------- ERROR MESSAGE -----------------------}}
                                    <form action="{{ route('employee_product.store') }}" method="post">
                                        @if($errors->all())
                                            <div class="alert alert-danger alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="employee_name">Employee Name</label>     
                                                <select name="user_id" class="form-control" id="employee_name" >
                                                        <option value="{{$requisition->user->id}}">{{$requisition->user->name}}</option>
                                                </select>              
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="product_id">Product Name</label>     
                                                <input type="hidden" name="requisition_id" value="{{$requisition->id}}">
                                                <select name="product_id" class="form-control" id="product_name" >
                                                    @foreach ($assigns as $assign)
                                                        @if ($assign->assign_status == 1)                                    
                                                            <option value="{{$assign->id}}">{{strtoupper($assign->company->company_abbr)}}/{{strtoupper($assign->product->name)}}-{{$assign->unique_id}}</option>
                                                        @endif
                                                        {{-- <option value="{{$assign->id}}">{{$assign_status}}</option> --}}
                                                    @endforeach
                                                </select>              
                                            </div>
                                            @csrf
                                            <div class="mx-auto">
                                                <button type="submit" class="btn btn-success">Assign</button>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{url('requisition/reject')}}/{{$requisition->id}}" class="btn btn-danger-outline">Reject</a>
                                            </div>
                                            @if (Auth::user()->role == 2 && $requisition->status != 3)
                                                <div class="col-md-3">
                                                    <a href="{{url('requisition/forward')}}/{{$requisition->id}}" class="btn btn-info-outline">Forward</a>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                    </div>
                                </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    <script>
        $(function(){
            $("#product_name").select2();
        })
    </script>
@endsection