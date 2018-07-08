<?php

namespace App;

use App\Services\FileHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $guarded = ['id'];
    public $timestamps = true;

    public static function createPost($data, $file, $userId)
    {
        $fileHandler = new FileHandler();
        $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
        $path = public_path('img/news/' . $fileName);
        $fileHandler->loadFile($file, $path);
        $post = new Post();
        $post->title = $data['title'];
        $post->photo = $fileName;
        $post->description = $data['description'];
        $post->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $post->save();
    }

    public static function editPost($data, $post, $file, $userId)
    {
        if ($file != null) {
            $fileHandler = new FileHandler();
            $fileName = $userId . '_' . time() . '_' . $file->getClientOriginalName();
            $path = public_path('img/news/' . $fileName);
            $fileHandler->loadFile($file, $path);
            $data['photo'] = $fileName;
        }
        return $post->update($data);
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
