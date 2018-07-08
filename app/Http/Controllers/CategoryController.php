<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends MainDataController
{
    const TITLE_CODE = 4;

    public function manager()
    {
        $data = $this->getData();
        return view('category.manager', $data);
    }

    public function create()
    {
        $data = $this->getData();
        return view('category.create', $data);
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
        $data = $request->all();
        Category::createCategory($data);
        return redirect()->route('category.manager');
    }

    public function edit($categoryId)
    {
        $data = $this->getData();
        $category = Category::find($categoryId);
        $data['cat'] = $category;
        return view('category.edit', $data);
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
        $data = $request->all();
        Category::findOrFail($categoryId);
        Category::editCategory($data, $categoryId);
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
        $category = Category::find($categoryId);
        $data['cat'] = $category;
        $categoryProducts = Category::getCategoryProducts($categoryId);
        $data['catProducts'] = $categoryProducts;
        return view('category.category', $data);
    }
}
