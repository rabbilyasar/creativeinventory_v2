<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole');
    }

    public function index()
    {


        $reusableProducts = Product::join('stocks', 'products.id', '=', 'stocks.product_id')->where('category_status', 2)->get();
        $usableProducts = Product::join('stocks', 'products.id', '=', 'stocks.product_id')->where('category_status', 1)->get();


        // return $reusableProducts;
        // foreach ($stocksData as $stock) {
          
        //       $reusableProducts = Product::where('id', $stock->id)->get();# code...
        // } 

        // return $reusableProducts;
        
        // $stocks->groupBy(function($item, $key){
        //     return $item['quantity'];
        // });
        // return $x;

        // foreach ($stocks as $y => $quantity) {
        //     return $y;
        // }

        return view('stock.index', compact('reusableProducts', 'usableProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
