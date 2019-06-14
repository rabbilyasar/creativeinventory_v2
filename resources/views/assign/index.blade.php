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
                        <h4>PRODUCT LIST TABLE FOR RE-USABLE</h4>
                    </div>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Product Name</th>
                    <th>Assign Status</th>
                    <th>Product Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($assigns as $assign)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{$assign->created_at}}</td>
                    <td>{{strtoupper($assign->company->company_abbr)}}/{{strtoupper($assign->product->name)}}-{{$assign->unique_id}}</td>
                    <td>
                        @if ($assign->assign_status == 1)
                            <a href="{{route('assign.show', $assign->id)}}" class="btn btn-success form-control" >AVAILABLE</a>
                        @elseif ($assign->assign_status == 2)
                            <a href="{{route('assign.show', $assign->id)}}" class="btn btn-danger form-control" >OCCUPIED</a>
                        @endif
                    </td>
                    {{-- <td>{{$assign->employee_has_product->user->name}}</td> --}}
                    <td>
                        @if ($assign->product_status == 0)
                            <a href="{{route('assign.show', $assign->id)}}" class="btn btn-success form-control">OKAY</a>
                        @elseif ($assign->product_status == 1)
                            <a href="{{route('assign.show', $assign->id)}}" class="btn btn-danger form-control">NOT IN-SERVICE</a>
                        @elseif ($assign->product_status == 2)
                        <a href="{{route('assign.show', $assign->id)}}" class="btn btn-warning form-control">LOST</a>
                        @elseif ($assign->product_status == 3)
                        <a href="{{route('assign.show', $assign->id)}}" class="btn btn-info form-control">REPAIRING</a>
                        @endif
                    </td>

                    {{--<td>{{strtoupper($product->company->company_abbr)}}/{{strtoupper($product->name)}}-{{$product->unique_id}}</td> --}}
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