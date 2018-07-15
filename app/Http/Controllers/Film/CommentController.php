<?php

namespace App\Http\Controllers\Film;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\Film;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function store(Request $request, $film_id)
    {
        $inputs = $request->only('comment');
        $validator = Validator::make($inputs, [
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $user = Auth::user();
        $inputs['user_id'] = $user->id;

        $comment = new Comment($inputs);
        $film = Film::find($film_id);
        $film->comments()->save($comment);

        return response()->json($comment, 200);
    }
}
