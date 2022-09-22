<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::where('parent_id', 0)->get();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->subest_category != ''){
                return response()->json([
                    'success' => false,
                    'message' => "You Cant Do That"
               ]);
        }
        elseif($request->sub_category != ''){
            if (ProductCategory::create(['parent_id' => $request->sub_category, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
               ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
               ]);
            }
        }elseif($request->main_category != ''){
            if (ProductCategory::create(['parent_id' => $request->main_category, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
               ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
               ]);
            }
        }else{
            if (ProductCategory::create(['parent_id' => 0, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
               ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
               ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductCategory::find($id);
        $categoryParent = ProductCategory::where('id', $category->parent_id)->value('parent_id');
        $maincategories = ProductCategory::where('parent_id',0)->get();
        return view('admin.category.edit',compact('category','maincategories', 'categoryParent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        if($request->subest_category != '' || $request->subest_category == $category->id || $request->sub_category == $category->id || $request->main_category == $category->id){
            return response()->json([
                'success' => false,
                'message' => "You Cant Do That"
           ]);
        }
        elseif($request->sub_category != ''){
            if ($category->update(['parent_id' => $request->sub_category, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
            ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
            ]);
            }
        }elseif($request->main_category != ''){
            if ($category->update(['parent_id' => $request->main_category, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
            ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
            ]);
            }
        }else{
            if ($category->update(['parent_id' => 0, 'name' => $request->name])) {
                return response()->json([
                    'success' => true,
                    'message' => "Category Successfully Created"
            ]);
            }else {
                return response()->json([
                    'success' => false,
                    'message' => "Category Not Created"
            ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function onChange(Request $request)
    {
        $parent = ProductCategory::where('parent_id', $request->parent_id)->first()->value('id');
        $categories = ProductCategory::where('parent_id', $request->id)->get();
        return response()->json([
            'success' => $categories,
            'parent_id' => $parent,
       ]);
    }
}
