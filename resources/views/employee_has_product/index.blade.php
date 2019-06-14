@extends('layouts.dashboardapp')

@section('title', 'Product List')

@section('content')
{{------- BREADCRUMB -------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">{{strtoupper('Dashboard')}}</a>
            <span class="breadcrumb-item active">{{strtoupper('Product List')}}</span>
        </nav>
    </div>
</div>

<div class="row">
    {{------------- START PRODUCT LIST TABLE FOR REUSABLE---------------}}
        <div class="col-md-12">
            <table class="table table-bordered" id="assign_list">
                    <div class="bg-dark text-center text-white">
                        <h4>ASSIGNED PRODUCT LIST</h4>
                    </div>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Product Name</th>
                    <th>Employee Name</th>
                </tr>
                </thead>
                <tbody>
                @forelse($assigns as $assign)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{$assign->created_at->format('d-m-y')}}</td>
                    <td>{{strtoupper($assign->assign->product->name)}}</td>
                    <td>{{$assign->user->name}}</td>
                    {{-- <td>{{$assign->assign->}}</td> --}}
                </tr>
                @empty
                <tr class="text-center text-danger">
                    <td colspan="7">No Product Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    {{---------- END SUPPLIER LIST TABLE FOR REUSABLE-------------}}
</div>
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function(){
            $('#assign_list').DataTable();
        });
    </script>

@endsection