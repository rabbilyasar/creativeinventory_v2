@extends('layouts.dashboardapp')

@section('title', 'ASSIGN UNIQUE ID')

@section('content')
{{---------------- BREADCRUMB  ---------------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">{{strtoupper('Dashboard')}}</a>
            <span class="breadcrumb-item active">{{strtoupper('Assign to employee')}}</span>
        </nav>
    </div>
</div>
<div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-head text-center bg-dark text-white">
                <h4>ASSIGN UNIQUE ID</h4>
            </div>
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
                @if(session('warning'))
                    <div class="alert alert-danger alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ session('warning') }}
                    </div>
                @endif
            {{-------------------- ERROR MESSAGE -----------------------}}
            <form action="{{ route('assign.store') }}" method="post">
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
                    <div class="form-group col-md-12">
                        <label for="product_id">Product Name</label>     
                        <select name="product_id" class="form-control product_id" id="product_id1" >
                            <option value="">Select product name</option>
                            @foreach ($reUsableProducts as $product)
                                <option value="{{$product->id}}">{{$product->name}} -> {{$product->supplier->name}}</option>
                            @endforeach
                        </select>              
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Company Name</label>
                            <select name="company_id" class="form-control company_abbr" required>
                                <option value="">Select company</option>
                            </select>
                        </div>
                        <div class="col-md-1 mt-3 text-center">
                            <h1>/</h1>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Product Name</label>
                            <select name="stock_id" class="form-control product_name" required>
                                <option value="">Select product name</option>
                            </select>
                        </div>
                        <div class="col-md-1 mt-3 text-center">
                            <h1>-</h1>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Unique ID:</label>
                            <input type="number" class="form-control" name="unique_id" value="{{old('unique_id')}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn form-control" id="add_more">Submit</button>
                        </div>
                        
                        @csrf
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $(function(){
            $(".product_id").change(function(){
                var product_id = $(this).val()

                // alert(product_id);
                // laravel ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/get/product/id',
                    data: {product_id, product_id},
                    success: function (data) {
                       $('.company_abbr').html(data)
                    // alert(data);
                    }
                });
            });

            $(".product_id").change(function(){
                var product_id = $(this).val()

                // alert(product_id);
                // laravel ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/get/product/name',
                    data: {product_id, product_id},
                    success: function (data) {
                       $('.product_name').html(data)
                    // alert(data);
                    }
                });
            });

            $('#product_id1').select2();
        });
    </script>
@endsection