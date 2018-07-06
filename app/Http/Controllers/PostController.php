<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use MainData;
    const TITLE_CODE = 3;

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
