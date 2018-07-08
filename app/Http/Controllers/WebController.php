<?php

namespace App\Http\Controllers;

use App\Product;

class WebController extends Controller
{

    public function index()
    {
        $products = Product::getLastProducts();
        return view('web.index', ['products' => $products]);
    }
}
