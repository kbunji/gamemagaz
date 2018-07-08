<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function manager()
    {
        return view('product.manager');
    }

    public function all(Request $request)
    {
        $categoryId = $request->get('categoryId');
        $products = $this->getCategoryProducts($categoryId);
        $data['products'] = $products;
        return view('product.manager', $data);
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
        $product = Product::find($productId);
        $data['product'] = $product;
        return view('product.product', $data);
    }

    public function create()
    {
        return view('product.create');
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'categoryId' => 'required|integer',
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        $data = $request->all();
        $fileHandler = new FileHandler();
        $file = $fileHandler->getRequestFile($request);
        $userId = Auth::id();
        Product::createProduct($data, $file, $userId);
        return redirect()->route('product.manager');
    }

    public function edit($productId)
    {
        $product = Product::find($productId);
        $data['product'] = $product;
        return view('product.edit', $data);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'category_id' => 'required|integer',
        ]);
    }

    public function update($productId, Request $request)
    {
        $this->checkUpdateRequest($request);
        $product = Product::findOrFail($productId);
        $data = $request->all();
        $fileHandler = new FileHandler();
        $file = $fileHandler->getRequestFile($request);
        $userId = Auth::id();
        Product::editProduct($data, $product, $file, $userId);
        return redirect()->route('product.manager');
    }

    public function delete($productId)
    {
        Product::destroy($productId);
        return redirect()->route('product.manager');
    }

    protected function checkSearchRequest(Request $request)
    {
        $this->validate($request, [
            'search' => 'string|min:3'
        ]);
    }

    public function search(Request $request)
    {
        $this->checkSearchRequest($request);
        $value = $request->get('search');
        $searchProducts = Product::searchProduct($value);
        $data['searchProducts'] = $searchProducts;
        return view('product.search')->with($data);
    }
}
