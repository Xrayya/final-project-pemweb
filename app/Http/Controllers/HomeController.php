<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        // $post = Post::where('id', 1)->get();
        $users = $post->user;
        return view('tester', ['data' => $users]);
    }
}
