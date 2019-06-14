@extends('layouts.dashboardapp')

@section('title', 'CHANGE PRODUCT STATE')

@section('content')
{{---------------- BREADCRUMB  ---------------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">DASHBOARD</a>
            <span class="breadcrumb-item active">CHANGE PRODUCT STATE</span>
        </nav>
    </div>
</div>
<div class="card col-md-12">
    <div class="card-head p-2 bg-dark text-white text-center">
        <h2>CHANGE PRODUCT STATE</h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card-body mt-3">
                    @if(session('message'))
                    <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    {{ session('message') }}
                    </div>
                    @endif
                <h2 class="text-center"> <strong>CHANGE REQUISITION STATUS</strong> </h2>
                <h4 class="mb-5 text-center">Current status: <span class=" error">dfljdf</span></h4>
                <form action="{{route('change.assign.status', $assign->id)}}" method="POST">
                    <select name="assign_status" id="" class="form-control">
                        <option value="">-- Select Status --</option>
                        <option value="1">AVAILABLE</option>
                        <option value="2">OCCUPIED</option>
                    </select>
                    @csrf
                    <button type="submit" class="form-control mt-3">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body mt-3">
                    @if(session('message1'))
                    <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    {{ session('message1') }}
                    </div>
                    @endif
                <h2 class="text-center"> <strong>CHANGE PRODUCT STATUS</strong> </h2>
                <h4 class="mb-5 text-center">Current status: <span class=" error">dfljdf</span></h4>
                <form action="{{route('change.product.status', $assign->id)}}" method="POST">
                    <select name="product_status" id="" class="form-control">
                        <option value="">-- Select Status --</option>
                        <option value="0">OKAY</option>
                        <option value="1">NOT IN-SERVICE</option>
                        <option value="2">LOST</option>
                        <option value="3">REPAIRING</option>
                    </select>
                    @csrf
                    <button type="submit" class="form-control mt-3">Submit</button>
                </form>
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