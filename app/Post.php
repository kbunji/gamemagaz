<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $guarded = ['id'];
    public $timestamps = true;
    public static function getAll()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return $posts;
    }

    public static function getLastPosts()
    {
        $posts = Post::limit(3)->orderBy('created_at', 'desc')->get();
        return $posts;
    }

    public static function getPost($postId)
    {
        $post = DB::table('posts')->where('id', $postId)->first();
        return $post;
    }
}
