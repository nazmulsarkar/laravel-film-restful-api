<?php

namespace App\Http\Controllers\Film;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->only('comment');
        $inputs['user_id'] = $user->id;

        $validator = Validator::make($inputs, [
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $comment = Comment::create($inputs);
        return response()->json($comment, 200);
    }

    public function delete(Comment $film)
    {
        $film->delete();

        return response()->json(null, 204);
    }
}
