<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public $timestamps = true;

    protected $guarded = ['id'];

    public static function createProduct(Request $request)
    {
        $fileName = null;
        $fileHandler = new FileHandler();
        if ($fileHandler->hasRequestFile($request)) {
            $file = $request->file('photo');
            $fileName = Auth::id() . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
        }
        $product = new Product();
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        if ($fileName != null) {
            $product->photo = $fileName;
        }
        $product->description = $request->get('description');
        $product->category_id = $request->get('categoryId');
        $product->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $product->save();
    }

    public static function editProduct(Request $request, $productId)
    {
        $fileName = null;
        $fileHandler = new FileHandler();
        if ($fileHandler->hasRequestFile($request)) {
            $file = $request->file('photo');
            $fileName = Auth::id() . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
        }
        $product = Product::find($productId);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        if ($fileName != null) {
            $product->photo = $fileName;
        }
        $product->description = $request->get('description');
        $product->category_id = $request->get('categoryId');
        $product->updated_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $product->save();
    }

    public static function getAll()
    {
        $products = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->get();
        return $products;
    }

    public static function getCategoryProducts($categoryId)
    {
        $products = DB::table('products')
            ->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->get();
        return $products;
    }

    public static function getLastProducts()
    {
        $posts = DB::table('products')->orderBy('created_at', 'desc')->paginate(6);
        return $posts;
    }

    public static function getProduct($productId)
    {
        $product = DB::table('products')->where('id', $productId)->first();
        return $product;
    }

    public static function searchProduct($value)
    {
        $products = Product::where('name', 'LIKE', "%$value%")->paginate(6);
        return $products;
    }
}
