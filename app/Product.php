<?php

namespace App;

use App\Services\FileHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public $timestamps = true;

    const PAGINATE_PRODUCTS = 6;

    protected $guarded = ['id'];

    public static function createProduct($data, $file, $userId)
    {
        $fileName = null;
        $fileHandler = new FileHandler();
        if ($file != null) {
            $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
        }
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        if ($fileName != null) {
            $product->photo = $fileName;
        }
        $product->description = $data['description'];
        $product->category_id = $data['categoryId'];
        $product->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $product->save();
    }

    public static function editProduct($data, $productId, $file, $userId)
    {
        $fileName = null;
        $fileHandler = new FileHandler();
        if ($file != null) {
            $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
        }
        $product = Product::find($productId);
        $product->name = $data['name'];
        $product->price = $data['price'];
        if ($fileName != null) {
            $product->photo = $fileName;
        }
        $product->description = $data['description'];
        $product->category_id = $data['categoryId'];
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
        $posts = DB::table('products')->orderBy('created_at', 'desc')->paginate(static::PAGINATE_PRODUCTS);
        return $posts;
    }

    public static function searchProduct($value)
    {
        $products = Product::where('name', 'LIKE', "%$value%")->paginate(static::PAGINATE_PRODUCTS);
        return $products;
    }
}
