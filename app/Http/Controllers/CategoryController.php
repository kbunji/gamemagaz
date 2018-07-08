<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function manager()
    {
        return view('category.manager');
    }

    public function create()
    {
        return view('category.create');
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required:string',
            'description' => 'required:string'
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
        $category = Category::find($categoryId);
        return view('category.edit', ['cat' => $category]);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'name' => 'required:string',
            'description' => 'required:string'
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
        $category = Category::find($categoryId);
        $data['cat'] = $category;
        $categoryProducts = Category::getCategoryProducts($categoryId);
        $data['catProducts'] = $categoryProducts;
        return view('category.category', $data);
    }
}
