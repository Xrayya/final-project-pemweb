<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
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
