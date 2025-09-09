<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    private $product;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("admin.pages.product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories => Category::where('status', 1)->get(),
        return view("admin.pages.product.add", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->product = Product:: newProduct($request);
        ProductImage::newProductImage($request->other_image, $this->product->id);
        return back()->with('message','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.pages.product.details',[
            'product'=>Product::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',[
            'product'=>$product,
            'productImages' => ProductImage::where('product_id',$product->id)->get(),
            'categories' => Category::where('status', 1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->product = Product:: updateProduct($request, $id);
        ProductImage::updateProductImage($request->other_image, $this->product->id);
        return back()->with('message','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::deleteProduct($id);
        return back()->with('message','Product Info Deleted Successfully');
    }

    /**
     * change Status.
     */
    public function info($id){
        Product::checkStatus($id);
        return back()->with('message', 'Product Status Updated Successfully');
    }
}
