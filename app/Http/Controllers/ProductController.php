<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::latest()->paginate(3);
        if(isset($_GET['query'])){
            $search = $_GET['query'];
            $products = Product::where('name','LIKE',"%".$search."%")->orWhere('id','LIKE',"%".$search."%")->paginate(3);
            return view('products.index',compact('products'));
        }
        else{
            return view('products.index',compact('products'))->with(request()->input('page'));
        }
        
        
        
        
        
        // return view('products.index',compact('products'))->with(request()->input('page'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required',
            'details' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //Show Product
        return view('products.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //Edit The Data
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //Update 
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //Delete the Product
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully.');
    }
    
    public function CategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone number' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('category.index')
                        ->with('success','Category created successfully.');
    }

    public function CategoryDestroy(Category $category)
    {
        //Delete the Product
        $category->delete();
        return redirect()->route('category.index')
                        ->with('success','category deleted successfully.');
    }


    public function CategoryUpdate(Request $request, Category $category)
    {
        //Update 
        $request->validate([
            'name' => 'required',
            'phone number' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')
                        ->with('success','Category updated successfully.');
    }

    public function CategoryEdit(Category $category)
    {
        //Edit The Data
        return view('category.edit',compact('category'));
    }

    public function CategoryIndex(Request $request)
    {
        //
        dd("I am in "); 
        $category = Category::latest()->paginate(3);
        if(isset($_GET['query'])){
            $search = $_GET['query'];
            $category = Category::where('name','LIKE',"%".$search."%")->orWhere('phone number','LIKE',"%".$search."%")->paginate(3);
            return view('category.index',compact('category'));
        }
        else{
            return view('category.index',compact('category'))->with(request()->input('page'));
        }
    }
}
// Check if route is :
    