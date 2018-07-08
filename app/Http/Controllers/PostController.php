<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends MainDataController
{
    const TITLE_CODE = 3;

    public function manager()
    {
        $data = $this->getData();
        $allPosts = Post::orderBy('created_at', 'desc')->get();
        $data['posts'] = $allPosts;
        return view('post.manager')->with($data);
    }

    public function create()
    {
        $data = $this->getData();
        return view('post.create')->with($data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        $data = $request->all();
        $fileHandler = new FileHandler();
        $file = $fileHandler->getRequestFile($request);
        $userId = Auth::id();
        Post::createPost($data, $file, $userId);
        return redirect()->route('post.manager');
    }

    public function edit($postId)
    {
        $data = $this->getData();
        $product = Post::getPost($postId);
        $data['post'] = $product;
        return view('post.edit', $data);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
    }

    public function update($postId, Request $request)
    {
        $this->checkUpdateRequest($request);
        Post::findOrFail($postId);
        $data = $request->all();
        $fileHandler = new FileHandler();
        $file = $fileHandler->getRequestFile($request);
        $userId = Auth::id();
        Post::editPost($data, $postId, $file, $userId);
        return redirect()->route('post.manager');
    }

    public function delete($productId)
    {
        Post::destroy($productId);
        return redirect()->route('post.manager');
    }

    public function all()
    {
        $data = $this->getData();
        $allPosts = Post::orderBy('created_at', 'desc')->get();
        $data['posts'] = $allPosts;
        return view('post.all', $data);
    }

    public function get($postId)
    {
        $data = $this->getData();
        $post = Post::getPost($postId);
        $data['post'] = $post;
        return view('post.post', $data);
    }
}
