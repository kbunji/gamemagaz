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
        $product = new Product();
        if ($file != null) {
            $fileHandler = new FileHandler();
            $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
            $product->photo = $fileName;
        }
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->category_id = $data['categoryId'];
        $product->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $product->save();
    }

    public static function editProduct($data, $product, $file, $userId)
    {
        if ($file != null) {
            $fileHandler = new FileHandler();
            $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
            $data['photo'] = $fileName;
        }
        return $product->update($data);
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
