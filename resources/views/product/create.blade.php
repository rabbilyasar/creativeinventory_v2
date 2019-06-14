@extends('layouts.dashboardapp')

@section('title', 'ADD PRODUCT')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">DASHBOARD</a>
            <span class="breadcrumb-item active">ADD PRODUCT</span>
        </nav>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{ session('success') }}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-danger alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{ session('warning') }}
    </div>
@endif

{{---------------- ADD PRODUCT FOR USABLE --------------}}
<div class="col-md-10 offset-1">
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
    <div class="card">
        <div class="card-head text-center bg-dark text-white">
            <span><h4>ENTER PRODUCT DETAILS</h4></span>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Product Name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Supplier Name</label>
                        <select name="supplier_id" class="form-control" required id="supplier_name">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Category</label>
                        <select name="category_status" id="" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="2">Re-Usable</option>
                            <option value="1">Non-Reusable</option>
                        </select>
                    </div>
                    @csrf
                    <div class="form-group col-md-2">
                        {{-- <label for=""></label> --}}
                        <button type="submit" class="btn btn-success mt-4">Add product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('footer_scripts')
    <script>
    $(function(){
        $("#warehouse_name, #category_name, .category_abbr, #supplier_name").select2();
    });
    </script>
@endsection
