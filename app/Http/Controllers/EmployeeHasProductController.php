<?php

namespace App\Http\Controllers;

use App\employee_has_product;
use Illuminate\Http\Request;
use App\Requisition;
use App\Assign;
use Carbon\Carbon;

class EmployeeHasProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigns = Employee_has_product::orderBy('created_at', 'desc')->get();

        return view('employee_has_product.index', compact('assigns'));
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
        // return $request->all();

        $data = request()->validate([
            'user_id' => 'required',
            'product_id' => 'required'
        ]);

        Employee_has_product::insert([
            'user_id'  => $request->user_id, 
            'assign_id'  => $request->product_id, 
            'created_at'  => Carbon::now() 
        ]);

        // $assign = Assign::find($request->product_id);
        $requisition = Requisition::find($request->requisition_id);
        // echo $requisition;
        $requisition->update([
            'status' => 1
        ]);
        Assign::find($request->product_id)->update([
            'assign_status' => 2
        ]);
        return redirect('/')->withStatus('You have approved the request');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employee_has_product  $employee_has_product
     * @return \Illuminate\Http\Response
     */
    public function show(employee_has_product $employee_has_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee_has_product  $employee_has_product
     * @return \Illuminate\Http\Response
     */
    public function edit(employee_has_product $employee_has_product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employee_has_product  $employee_has_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee_has_product $employee_has_product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee_has_product  $employee_has_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee_has_product $employee_has_product)
    {
        //
    }
}
