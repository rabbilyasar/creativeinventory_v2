@extends('layouts.dashboardapp')

@section('title', 'Inventory list')
@section('active-stock', 'opened')

@section('content')


{{-- REUSABLE STOCK LIST --}}
<div class="row">
    <div class="col-md-12 pb-3">
        <table class="table table-bordered" id="stock_table">
                <div class="col-md-12 text-center bg-secondary p-2 text-white"> <strong>Reusable Inventory List</strong></div>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Product Name</th>
                    <th>Total QTY</th>
                    <th>Unit Price</th>
                    <th>Current Total Price</th>
                    <th>Unassigned QTY</th>
                    <th>Assigned QTY</th>
                    <th>Purchase Price</th>
                    <th>Exp. Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reusableProducts as $stock)
                    @if ($stock->quantity !== 0)                    
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$stock->created_at}}</td>
                            <td>                        
                                {{strtoupper($stock->name)}}
                            </td>
                            <td>{{$stock->quantity + $stock->assigned_quantity}}</td>
                            <td>৳ {{$stock->unit_price}}tk</td>
                            <td>৳ {{($stock->quantity + $stock->assigned_quantity) * $stock->unit_price}}tk</td>
                            <td>{{$stock->quantity}}</td>
                            <td>{{$stock->assigned_quantity}}</td>
                            <td>৳ {{$stock->total_price}}tk</td>
                            <td>{{$stock->exp_date}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- USABLE STOCK LIST --}}
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="stock_table">
                <div class="col-md-12 text-center bg-secondary p-2 text-white"> <strong>Usable Inventory List</strong></div>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Created at</th>
                    <th>Product Name</th>
                    <th>Total QTY</th>
                    <th>Unit Price</th>
                    <th>Current Total Price</th>
                    <th>Purchase Price</th>
                    <th>Exp. Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usableProducts as $stock)
                    @if ($stock->quantity !== 0)                    
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$stock->created_at}}</td>
                            <td>                        
                                {{strtoupper($stock->name)}}
                            </td>
                            <td>{{$stock->quantity}}</td>
                            <td>৳ {{$stock->unit_price}}tk</td>
                            <td>৳ {{$stock->quantity * $stock->unit_price }}tk</td>
                            <td>৳ {{$stock->total_price}}tk</td>
                            <td>{{$stock->exp_date}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
    $(document).ready( function () {
        $('#stock_table, #stock_table_sum').DataTable();
    } );
</script>
@endsection