<?php
/**
 * Created by PhpStorm.
 * User: Bunji
 * Date: 04.07.2018
 * Time: 15:37
 */

namespace App\Http\Controllers;


use App\Category;
use App\Order;
use App\OrderDetail;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Auth;

trait MainData
{
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

    abstract protected function getTitleCode();
}
