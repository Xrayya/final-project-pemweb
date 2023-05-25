<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('parent', null)->get();
        foreach ($posts as $post) {
            $post->liked = false;
            $likes = $post->likes;
            foreach ($likes as $like) {
                if ($like->id_user == auth()->user()->id) {
                    $post->liked = true;
                    break;
                }
            }
        }

        return view('home')
            ->with('title', 'Home')
            ->with('posts', $posts);
    }

    public function toggleLike(Request $request)
    {
        $like = Like::where('id_post', $request->id_post)->where('id_user', $request->id_user);
        $respons = [
            'id_post' => $request->id_post,
        ];

        if ($like->count() == 1) {
            $like->delete();
            $respons['status'] = 'deleted';
            echo json_encode($respons);
        } elseif ($like->count() == 0) {
            Like::create([
                'id_post' => $request->id_post,
                'id_user' => $request->id_user
            ]);
            $respons['status'] = 'created';
            echo json_encode($respons);
        }
    }
}
