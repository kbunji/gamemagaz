<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use MainData;
    const TITLE_CODE = 4;

    public function manager()
    {
        $data = $this->getData();
        return view('category.manager')->with($data);
    }

    public function create()
    {
        $data = $this->getData();
        return view('category.create')->with($data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        Category::createCategory($request);
        return redirect()->route('category.manager');
    }

    public function edit($categoryId)
    {
        $data = $this->getData();
        $category = Category::getCategory($categoryId);
        $data['cat'] = $category;
        return view('category.edit')->with($data);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
    }

    public function update($categoryId, Request $request)
    {
        $this->checkUpdateRequest($request);
        Category::editCategory($request, $categoryId);
        return redirect()->route('category.manager');
    }

    public function delete($categoryId)
    {
        Category::destroy($categoryId);
        return redirect()->route('category.manager');
    }

    public function get($categoryId)
    {
        $data = $this->getData();
        $category = Category::getCategory($categoryId);
        $data['cat'] = $category;
        $categoryProducts = Category::getCategoryProducts($categoryId);
        $data['catProducts'] = $categoryProducts;
        return view('category.category')->with($data);
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
