<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $products = Product::get();
        return view('product', ['products'=>$products, 'categories'=>$categories]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $productFromSameCategories = Product::where('subcategory_id', $product->subcategory_id)->get();
        return view('product-show', ['product'=>$product, 'productFromSameCategories'=>$productFromSameCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function showCategory($name, Request $request){
        $category = Category::where('slug', $name)->first();

        if($request->subcategory){
            $products = $this->filterProducts($request);
            $filterSubCategories = $this->getSubCategoriesId($request);

        } else if($request->min || $request->max){
            $filterSubCategories = null;
            $products = $this->filterByPrice($request);
        } else {
            $filterSubCategories = null;
            $products = Product::where('category_id', $category->id)->get();
        }

        $subcategories = SubCategory::where('category_id', $category->id)->get();
        $slug = $name;
        $category_id = $category->id;
        return view('category', ['products'=>$products, 'subcategories'=>$subcategories, 'slug'=>$slug, 'category_id'=>$category_id, 'filterSubCategories'=>$filterSubCategories]);
    }


    public function filterProducts(Request $request){
        $subId = [];
        $subcategory = SubCategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
        $products = Product::whereIn('subcategory_id',$subId)->get();
        return $products;
    }

    public function getSubCategoriesId(Request $request){
        $subId = [];
        $subcategory = SubCategory::whereIn('id', $request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId, $sub->id);
        }
       
        return $subId;
    }


    public function filterByPrice(Request $request){
        $categoryId = $request->categoryId;
        $product = Product::whereBetween('price',[$request->min,$request->max ])->where('category_id',$categoryId)->get();
        return $product;
    }
}
