<?php

namespace App\Http\Controllers;

use App\Product;

class WebController extends Controller
{
    use MainData;
    const TITLE_CODE = 1;

    public function index()
    {
        $data = $this->getData();
        $data['products'] = Product::getLastProducts();
        return view('web.index')->with($data);
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
