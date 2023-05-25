<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = Post::where('id_user', $user->id)->get();
        foreach ($posts as $post) {
            $post->liked = false;
            $likes = $post->likes;
            foreach ($likes as $like) {
                if ($like->id_user == $user->id) {
                    $post->liked = true;
                    break;
                }
            }
        }

        $isFollowed = Follow::where('id_follower', auth()->user()->id)->where('id_followed', $user->id)->count() == 1 ? true : false;

        return view("profile.show")
            ->with('title', 'Profile')
            ->with('user', $user)
            ->with('isFollowed', $isFollowed)
            ->with('followers', $user->follower)
            ->with('followings', $user->following)
            ->with('posts', $posts);
    }

    public function edit(User $user)
    {
        return view('profile.edit')
            ->with('title', 'Edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $rules = [
            'username' => 'required',
            'display_name' => 'required',
            'email' => 'required|email',
            'bio' => 'max:255'
        ];

        if ($request->username != auth()->user()->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->email != auth()->user()->email) {
            $rules['email'] = 'required|unique:users|email';
        }

        $validatedData = $request->validate($rules);

        User::where('id', auth()->user()->id)->update($validatedData);

        return redirect('/profile/' . auth()->user()->id);
    }
}
