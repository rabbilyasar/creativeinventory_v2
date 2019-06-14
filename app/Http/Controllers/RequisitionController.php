<?php

namespace App\Http\Controllers;

use App\Requisition;
use Illuminate\Http\Request;
use App\Product;
use App\Stock;
use Carbon\Carbon;
use Auth;
use App\Assign;

class RequisitionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::orderBy('created_at', 'desc')->get();
        return view('requisition.index', compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usable_products = Product::where('category_status', 1)->get();
        $reusable_products = Product::where('category_status', 2)->get();

        $products = Product::where('active_status', 1);
        $stocks = Stock::all();

        // return $usable_products;
        return view('requisition.create', compact('products', 'stocks' , 'usable_products', 'reusable_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric',
            // 'note' => 'required',
            'created_at' => Carbon::now()
        ]);
        Requisition::create($data + [
            'user_id'=> Auth::id()
        ]);

        return response()->json(['success'=>'Your request has been submitted succesfully']);
    }
    
    public function storeReusable(Request $request)
    {
        // return $request->all();
        $data = request()->validate([
            'product_id' => 'required',
            // 'note' => 'required',
            'created_at' => Carbon::now()
        ]);
        Requisition::create($data + [
            'user_id'=> Auth::id()
        ]);

        // return response()->json(['success'=>'Your request has been submitted succesfully']);
        return back()->withSuccess1('Your request has been submitted succesfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        $assigns = Assign::where('product_id', $requisition->product_id)->get();
        // dd($assign);
        // return $assign;
        return view('requisition.show', compact('requisition', 'assigns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
