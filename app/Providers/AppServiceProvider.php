<?php

namespace App\Providers;

use App\Category;
use App\OrderDetail;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        $data = $this->getData();
        View::share($data);
    }

    public function getData()
    {
        $data['categories'] = Category::getAll();
        $data['postsLast'] = Post::getLastPosts();
        $data['products'] = Product::getLastProducts();
        $data['orderProducts'] = 0;
        if (Auth::user()) {
            $data['orderProducts'] = OrderDetail::countOrderProducts(Auth::id());
        }
        return $data;
    }

    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
