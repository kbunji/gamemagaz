<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use MainData;
    const TITLE_CODE = 3;

    public function manager()
    {
        $data = $this->getData();
        $allPosts = Post::getAll();
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
        Post::createPost($request);
        return redirect()->route('post.manager');
    }

    public function edit($postId)
    {
        $data = $this->getData();
        $product = Post::getPost($postId);
        $data['post'] = $product;
        return view('post.edit')->with($data);
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
        Post::editPost($request, $postId);
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
        $allPosts = Post::getAll();
        $data['posts'] = $allPosts;
        return view('post.all')->with($data);
    }

    public function get($postId)
    {
        $data = $this->getData();
        $post = Post::getPost($postId);
        $data['post'] = $post;
        return view('post.post')->with($data);
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
