<?php

namespace App\Http\Controllers;

use App\Assign;
use Illuminate\Http\Request;
use App\Product;
use App\Requisition;
use App\User;
use App\Purchase;
use App\Stock;
use App\employee_has_product;

class AssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigns = Assign::orderBy('created_at', 'desc')->get();

        return view('assign.index', compact('assigns'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reUsableProducts = Product::where('category_status', 2 )->get();
        // $users = User::all();
        
        return view('assign.create', compact('reUsableProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();


        if (Assign::where('company_id', $request->company_id)->where('product_id', $request->product_id)->where('unique_id', $request->unique_id)->exists()) {
           return back()->withWarning('Record already exists');
        } else {
            $data = request()->validate([
            'company_id' => 'required',
            'product_id' => 'required',
            'stock_id' => 'required',
            'unique_id' => 'required|numeric'
            ]);

            Stock::where('id', $request->stock_id)->decrement('quantity', 1);
            
            foreach ( Stock::where('id', $request->stock_id)->get() as $stock ){
                if ($stock->assigned_quantity == 0){
                    Stock::where('id', $request->stock_id)->update(['assigned_quantity'=> 1 ]);
                } else{
                    Stock::where('id', $request->stock_id)->increment('assigned_quantity', 1);
                }
                // return $stock->all();
            }
            Assign::create($data);            

            return back()->withSuccess('Record has been inserted succesfully');
        }


    }

    public function reStore(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function show(Assign $assign)
    {
        return view('assign.show', compact('assign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function edit(Assign $assign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assign $assign)
    {

    }

    public function assignStatus(Request $request, Assign $assign)
    {
        // return $assign;
        $assign->update([
            'assign_status'=> $request->assign_status
        ]);

        return back()->withMessage('Assign Status Updated Succefully');
    }

    public function productStatus(Request $request, Assign $assign)
    {
        $assign->update([
            'product_status'=> $request->product_status
        ]);

        return back()->withMessage1('Product Status Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assign $assign)
    {
        //
    }

    public function getProductId(Request $request){
       
        $purchases = Purchase::where('product_id', $request->product_id)->get();

        $stringToSend = " ";

        foreach ($purchases as $purchase) {
            $stringToSend .= "<option value='".$purchase->company->id."'>".$purchase->company->company_abbr."</option>";
        }
        echo $stringToSend;
    }

    public function getProductName(Request $request){
       
        // $purchases = Purchase::where('product_id', $request->product_id)->get();
        // $purchaseStock = Stock::where('product_id', $request->product_id)->sum('quantity');
        // $purchaseStock = Stock::where('product_id', $request->product_id)->get();
        $stocks = Stock::where('product_id', $request->product_id)->get();
        

        $stringToSend1 = " ";

        // foreach ($purchases as $purchase) {
        //     $stringToSend1 .= "<option value='".$purchase->id."'>".$purchase->product->name ."->" .$purchase->product->first('quantity') ."</option>";
        // }
        foreach ($stocks as $stock) {
            if ($stock->quantity != 0) {
                # code...
                $stringToSend1 .= "<option value='".$stock->id."'>".$stock->product->name ."->" .$stock->quantity ."</option>";
            }
        }
        // $stringToSend1 .= 
        echo $stringToSend1;
    }
}
