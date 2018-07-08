<?php
/**
 * Created by PhpStorm.
 * User: Bunji
 * Date: 08.07.2018
 * Time: 18:41
 */

namespace App\Http\Controllers;


use App\Category;
use App\OrderDetail;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Auth;

abstract class MainDataController extends Controller
{
    const TITLE_CODE = 0;
    public function getData()
    {
        $data['categories'] = Category::getAll();
        $data['postsLast'] = Post::getLastPosts();
        $data['products'] = Product::getLastProducts();
        $data['title'] = self::getTitleCode();
        $data['orderProducts'] = 0;
        if (Auth::user()) {
            $data['orderProducts'] = OrderDetail::countOrderProducts(Auth::id());
        }
        return $data;
    }

    protected function getTitleCode()
    {
        return static::TITLE_CODE;
    }
}