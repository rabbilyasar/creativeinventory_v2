@extends('layouts.dashboardapp')

@section('content')
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">DASHBOARD</a>
            <span class="breadcrumb-item active">CATEGORY</span>
        </nav>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>SORT CATEGORY</strong>
        </div>
        <div class="card-body">
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
            @if(session('success'))
                <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('category.sort') }}" method="post">
            @csrf
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                        <label>Product Name</label>
                        <select name="product_id" id="" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Category Name</label>
                        <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Sort Category</button>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="bg-dark text-white p-2 text-center"><strong>SORT PRODUCT LIST</strong> </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorySorts as $categorySort)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{ $categorySort->product->name }}</td>
                  <td>{{ $categorySort->category->name }}</td>
                  <td>{{ $categorySort->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function(){
            $('.table').DataTable();
        })
    </script>    
@endsection