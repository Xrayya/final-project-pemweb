<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post' => 'required|min:1|max:255',
            'parent' => 'integer'
        ]);

        $validatedData['id_user'] = auth()->user()->id;

        Post::create($validatedData);

        return back()->with('success', 'Successfully upload post');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        $post->liked = false;
        $likes = $post->likes;
        foreach ($likes as $like) {
            if ($like->id_user == auth()->user()->id) {
                $post->liked = true;
                break;
            }
        }

        $comments = Post::where('parent', $id)->orderBy('created_at', 'desc')->get();
        foreach ($comments as $comment) {
            $comment->liked = false;
            $likes = $comment->likes;
            foreach ($likes as $like) {
                if ($like->id_user == auth()->user()->id) {
                    $comment->liked = true;
                    break;
                }
            }
        }

        return view('post.detail')
            ->with('title', 'Post')
            ->with('post', $post)
            ->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
