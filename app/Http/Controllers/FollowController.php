<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggleFollow(Request $request)
    {
        if ($request->followed === auth()->user()->id) {
            return back();
        }

        $followRelation = Follow::where('id_followed', $request->followed)->where('id_follower', auth()->user()->id);

        if ($followRelation->count() == 1) {
            $followRelation->delete();
            return back()->with('isFollowed', false);
        } elseif ($followRelation->count() == 0) {
            Follow::create([
                'id_followed' => $request->followed,
                'id_follower' => auth()->user()->id
            ]);
            return back()->with('isFollowed', true);
        }
    }
}
