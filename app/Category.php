<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function getAll()
    {
        $categories = Category::all();
        return $categories;
    }

    public static function createCategory($data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        return $category->save();
    }

    public static function editCategory($data, $categoryId)
    {
        $category = Category::find($categoryId);
        $category->name = $data['name'];
        $category->description = $data['description'];
        return $category->save();
    }

    public static function getCategoryProducts($categoryId)
    {
        $category = DB::table('products')
            ->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return $category;
    }
}
