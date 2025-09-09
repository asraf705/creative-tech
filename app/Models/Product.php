<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    private static $product, $image, $imageUrl, $directory, $imageName, $extension, $images;

    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$extension = self::$image->getClientOriginalExtension();
        self::$imageName = rand(10000, 500000) . '.' . self::$extension;
        self::$directory = 'upload/product-images/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory . self::$imageName;
    }

    public static function newProduct($request)
    {
        self::$imageUrl = $request->file('image')
            ? self::getImageUrl($request)
            : null;

        self::$product = new Product();
        return self::saveBasicInfo(self::$product, $request, self::$imageUrl);
    }

    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);

        if ($request->file('image')) {
            if (self::$product->image && file_exists(self::$product->image)) {
                unlink(self::$product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = self::$product->image;
        }

        return self::saveBasicInfo(self::$product, $request, self::$imageUrl);
    }

    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);

        // delete main image
        if (self::$product->image && file_exists(self::$product->image)) {
            unlink(self::$product->image);
        }

        // delete multiple images
        self::$images = ProductImage::where('product_id', self::$product->id)->get();
        foreach (self::$images as $img) {
            if ($img->image && file_exists($img->image)) {
                unlink($img->image);
            }
            $img->delete();
        }

        self::$product->delete();
    }

    private static function saveBasicInfo($product, $request, $imageUrl)
    {
        $product->category_id       = $request->category_id;
        $product->name              = $request->name;
        $product->code              = $request->code;
        $product->short_description = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->image             = $imageUrl;
        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        $product->video_link        = $request->video_link;
        $product->regular_price     = $request->regular_price;

        if ($request->selling_price) {
            $product->selling_price   = $request->selling_price;
            $product->discount_type   = $request->discount_type;
            $product->discount_amount = $request->discount_amount;
        }

        $product->stock_amount = $request->stock_amount;
        $product->save();

        return $product;
    }

    public static function checkStatus($id)
    {
        self::$product = Product::find($id);
        self::$product->status = self::$product->status == 1 ? 0 : 1;
        self::$product->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
