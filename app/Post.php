<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $guarded = ['id'];
    public $timestamps = true;

    public static function createPost(Request $request)
    {
        $fileHandler = new FileHandler();
        $file = $request->file('photo');
        $fileName = Auth::id() . '_' . time() . '_' . $file->getClientOriginalName();
        $path = public_path('img/news/' . $fileName);
        $fileHandler->loadFile($file, $path);
        $post = new Post();
        $post->title = $request->get('title');
        $post->photo = $fileName;
        $post->description = $request->get('description');
        $post->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $post->save();
    }

    public static function editPost(Request $request, $postId)
    {
        $fileName = null;
        $fileHandler = new FileHandler();
        if ($fileHandler->hasRequestFile($request)) {
            $file = $request->file('photo');
            $fileName = Auth::id() . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/cover/' . $fileName);
            $fileHandler->loadFile($file, $path);
        }
        $post = Post::find($postId);
        $post->title = $request->get('title');
        if ($fileName != null) {
            $post->photo = $fileName;
        }
        $post->description = $request->get('description');
        $post->updated_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $post->save();
    }

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
