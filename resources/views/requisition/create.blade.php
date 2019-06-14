@extends('layouts.dashboardapp')

@section('title', 'REQUISITION FORM')
@section('active-requisition', 'opened')

@section('content')
{{---------------- BREADCRUMB  ---------------}}
<div class="row">
    <div class="col-md-12">
        <nav class="breadcrumb bg-white">
            <a class="breadcrumb-item" href="{{ route('home') }}">{{strtoupper('DASHBOARD')}}</a>
            <span class="breadcrumb-item active">{{strtoupper('REQUISITION FORM')}}</span>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-head text-center bg-dark text-white">
                <h4>{{strtoupper('Enter Requisition Details for Usable')}}</h4>
            </div>
    {{----------------- ERROR MESSAGE ------------------}}
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
    {{-------------- SUCCESS MESSAGES -------------}}
                <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" style="display:none" role="alert" id="alert_success1"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif
                {{-- FORM START FOR USABLE--}}
                <form id="myForm1">
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
                    <div class="category_select_container">
                        <div class="row mb-4">
                            <div class="col-md-6 py-4">
                                <select name="product_id" class="form-control product_name" id="product_name1" required>
                                    <option value="">Select product name</option>
                                    @foreach ($usable_products as $product)
                                        @if (App\Purchase::where('product_id', $product->id)->where('supplier_id', $product->supplier_id)->exists())  
                                                <option value="{{$product->id}}">{{strtoupper($product->name)}} #{{($product->supplier->name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 py-4">
                                <input class="form-control" type="number" id="quantity1" name="quantity" placeholder="Quantity" autocomplete="off" required>
                            </div>
                            <div class="col-md-2">
                                <textarea name="note" id="note1" class="form-control" placeholder="Add note (optional)" cols="2"></textarea>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success" id="submit1">Request</button>
                </form>
                {{-- FORM END --}}
            </div>
        </div>
    </div>
</div>

{{-- FOR RE-USABLE --}}
<div class="row">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-head text-center bg-dark text-white">
                <h4>{{strtoupper('Enter Requisition Details For Re-Usable')}}</h4>
            </div>
            <div class="alert alert-success alert-fill alert-border-left alert-close1 alert-dismissible fade show" style="display:none" role="alert" id="alert_success"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="card-body">
                <form action="{{route('store.requisition.reusable')}}" id="myForm" method="POST">
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
                    @if(session('success1'))
                        <div class="alert alert-success alert-fill alert-border-left alert-close alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ session('success1') }}
                        </div>
                    @endif
                    <div class="category_select_container">
                        <div class="row mb-4">
                            <div class="col-md-7 py-4">
                                <select name="product_id" class="form-control product_name" id="product_name" required>
                                    <option value="">Select product name</option>
                                    @foreach ($reusable_products as $product)
                                        @if (App\Purchase::where('product_id', $product->id)->where('supplier_id', $product->supplier_id)->exists())
                                            @if (App\Assign::where('product_id', $product->id)->exists())
                                                <option value="{{$product->id}}">{{strtoupper($product->name)}} #{{$product->supplier->name}} #{{$product->assign->company->company_abbr}}</option>
                                            @endif                                          
                                        @endif
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <textarea name="note" id="note2" class="form-control" placeholder="Add note (optional)" cols="2"></textarea>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success" id="submit2">Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
    <script>
        $(function(){
            //select2
            $("#product_name, #product_name1").select2();
            
            $("#submit1").click(function(e){
                e.preventDefault();

                // alert(product_name+quantity+note);
                // laravel ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/requisition',
                    data: {
                        product_id: $("#product_name1").val(), 
                        quantity: $("#quantity1").val(), 
                        note: $("#note1").val()
                        },
                    success: function (data) {
                    //    $('.product_name').html(data)
                    // alert(data);
                    $('#alert_success1').show();
                    $('#alert_success1').html(data.success);
                    }
                });
                $("#myForm1")[0].reset();
                // $('.close').alert();
            });

////sdkfsjf///
            // $("#submit2").click(function(e){
            //     e.preventDefault();
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     $.ajax({
            //         type: 'POST',
            //         url: '/requisition/store/reusable',
            //         data: {
            //             product_id: $("#product_name2").val(), 
            //             note: $("#note2").val()
            //             },
            //         success: function (data) {
            //         //    $('.product_name').html(data)
            //         // alert(data);
            //         $('#alert_success').show();
            //         $('#alert_success').html(data.success);
            //         }
            //     });
            //     $("#myForm")[0].reset();
            // });

///sdfsdjfjk////
            
            // $("#submit2").click(function(e){
            //     e.preventDefault();

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });

            //     $.ajax({
            //         type: 'POST',
            //         url: '/requisition/store/reusable',
            //         data: {
            //             product_id: $("#product_name2").val(), 
            //             note: $("#note2").val()
            //             },
            //         success: function (data) {

            //         $('#alert_success').show();
            //         $('#alert_success').html(data.success);
            //         }
            //     });
            //     $("#myForm")[0].reset();

            // });


            $("#alert_success1").hide();

            $("#submit1").click(function showAlert() {
            $("#alert_success1").fadeTo(2000, 5000).slideUp(100, function(){
                $("#alert_success1").slideUp(5000);
                });   
            });
            // $("#alert_success").hide();

            // $("#submit2").click(function showAlert() {
            // $("#alert_success").fadeTo(2000, 5000).slideUp(100, function(){
            //     $("#alert_success").slideUp(5000);
            //     });   
            // });
        });
    </script>
@endsection