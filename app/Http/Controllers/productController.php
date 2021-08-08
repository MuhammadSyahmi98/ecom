<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', ['products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();

        return view('admin.product.create', ['categories'=> $categories, 'subcategory'=>$subcategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required| min:3',
            'description'=> 'required| min:3',
            'image'=> 'required|mimes:png,jpg,jpeg',
            'price'=> 'required| numeric',
            'additional_info'=> 'required',
            'category'=> 'required',
            'subcategory'=> 'required'
        ]);

        $image = $request->file('image')->store('public/products');

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price,
            'additional_info' => $request->additional_info,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory
        ]);

        return redirect()->back()->with('message', 'Successfully created product');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('admin.product.edit', ['product'=>$product, 'categories'=>$categories]);
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

        $product = Product::findOrFail($id);
        $image = $product->image;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/products');
            Storage::delete($product->image);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $image;
        $product->price = $request->price;
        $product->additional_info = $request->additional_info;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;

        $product->save();

        return redirect()->route('product.index')->with('message', 'Successfully updated the product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $filename = $product->image;
        $product->delete();
        Storage::delete($filename);
    }

    public function loadSubCategories(Request $request, $id){
        $subcategory = SubCategory::where('category_id', $id)->pluck('name', 'id');

        return response()->json($subcategory);
    }
}
