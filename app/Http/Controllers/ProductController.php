<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use MainData;
    const TITLE_CODE = 2;

    public function manager()
    {
        $data = $this->getData();
        return view('product.manager')->with($data);
    }

    public function all(Request $request)
    {
        $categoryId = $request->get('categoryId');
        $data = $this->getData();
        $products = $this->getCategoryProducts($categoryId);
        $data['products'] = $products;
        return view('product.manager')->with($data);
    }

    protected function getCategoryProducts($categoryId)
    {
        if ($categoryId != 0) {
            return Product::getCategoryProducts($categoryId);
        }
        return Product::getAll();
    }

    public function get($productId)
    {
        $data = $this->getData();
        $product = Product::getProduct($productId);
        $data['product'] = $product;
        return view('product.product')->with($data);
    }

    public function create()
    {
        $data = $this->getData();
        return view('product.create')->with($data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'categoryId' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        Product::createProduct($request);
        return redirect()->route('product.manager');
    }

    public function edit($productId)
    {
        $data = $this->getData();
        $product = Product::getProduct($productId);
        $data['product'] = $product;
        return view('product.edit')->with($data);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'categoryId' => 'required',
        ]);
    }

    public function update($productId, Request $request)
    {
        $this->checkUpdateRequest($request);
        Product::editProduct($request, $productId);
        return redirect()->route('product.manager');
    }

    public function delete($productId)
    {
        Product::destroy($productId);
        return redirect()->route('product.manager');
    }


    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
