<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Product::create($request->all())) {
            return response()->json([
                'success' => true,
                'message' => "Product Successfully Created"
           ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => "Product Not Created"
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.product.edit', compact('product', 'categories'));
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
        if ($product->update($request->all())) {
            return response()->json([
                'success' => true,
                'message' => "Product Successfully Updated"
           ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => "Product Not Updated"
           ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->back()->with(['success' => 'Delete Successful']);
        }else{
            return redirect()->back()->with(['error' => 'Delete Failed']);
        }
        // if ($product->delete()) {
        //     return response()->json([
        //         'success' => true,
        //         'message' => "Product Successfully Deleted"
        //    ]);
        // }else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => "Product Not Deleted"
        //    ]);
        // }
    }
}
