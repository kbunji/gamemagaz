<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function manager()
    {
        $allPosts = Post::orderBy('created_at', 'desc')->get();
        return view('post.manager', ['posts' => $allPosts]);
    }

    public function create()
    {
        return view('post.create');
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'photo' => 'required',
            'description' => 'required|string'
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
        $product = Post::getPost($postId);
        $data['post'] = $product;
        return view('post.edit', $data);
    }

    protected function checkUpdateRequest($request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
    }

    public function update($postId, Request $request)
    {
        $this->checkUpdateRequest($request);
        $post = Post::findOrFail($postId);
        $data = $request->all();
        $fileHandler = new FileHandler();
        $file = $fileHandler->getRequestFile($request);
        $userId = Auth::id();
        Post::editPost($data, $post, $file, $userId);
        return redirect()->route('post.manager');
    }

    public function delete($productId)
    {
        Post::destroy($productId);
        return redirect()->route('post.manager');
    }

    public function all()
    {
        $allPosts = Post::orderBy('created_at', 'desc')->get();
        $data['posts'] = $allPosts;
        return view('post.all', $data);
    }

    public function get($postId)
    {
        $post = Post::getPost($postId);
        $data['post'] = $post;
        return view('post.post', $data);
    }
}
