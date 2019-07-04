<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\CategorySort;

class CategoryController extends Controller
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
        $trashed = Category::onlyTrashed()->get();
        $categories = Category::all();

        return view('category.index', compact('categories', 'trashed'));

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
        $request->validate([
            'name' => 'required|unique:categories,name',
            'created_at' => Carbon::now()
        ]);

        Category::create($request->except('_token')); //STORE EXCEPT TOKEN AND PASS ON USER ID AS AUTH ID
        return back()->withSuccess('Category added succesfully'); //'withVariable' is laravel sweetener to store variable
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = request()->validate([
            'name' => 'required|unique:categories,name,' .$category->id, //VALIDATE EXCEPT DESIRED ID
        ]);
        $category->update($data);
        return redirect('/category')->withStatus($category->name . ' has been edited succesfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->withDelete($category->name. ' has been sent to trash');
    }

    public function restore($category){
        Category::withTrashed()->find($category)->restore();
        return back()->withRestore('Item has been restored');
    }

    public function forceDelete($category){
        Category::withTrashed()->find($category)->forceDelete();
        return back()->withForced('Item has been deleted permanently');
    }

    public function sortView()
    {
        // echo 'skjds';
        $categories= Category::all();
        $products= Product::all();
        $categorySorts = CategorySort::all();

        return view('category.sort', compact('categories', 'products', 'categorySorts'));
    }
    public function sort(Request $request)
    {
        CategorySort::insert([
            'product_id' => $request->product_id,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now()
        ]);
        
        return back();
    }
}
