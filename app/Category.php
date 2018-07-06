<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function getAll()
    {
        $categories = Category::all();
        return $categories;
    }

    public static function createCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        return $category->save();
    }

    public static function editCategory(Request $request, $categoryId)
    {
        Category::find($categoryId)->update($request->all());
    }

    public static function getCategory($categoryId)
    {
        $category = DB::table('categories')->where('id', $categoryId)->first();
        return $category;
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
