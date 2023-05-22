<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home')
            ->with('title', 'Home')
            ->with('posts', Post::all());
    }
}
