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
        $posts = Post::orderBy('created_at', 'desc')->get();
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
}

