<?php

namespace App\Http\Controllers\Film;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use Validator;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Storage;

class FilmController extends Controller
{
    public function index()
    {
        return response()->json(Film::all(), 200);
    }

    public function show(Film $slug)
    {
        return response()->json($slug, 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->only('title', 'description', 'release_on', 'rating', 'price', 'country', 'genre', 'photo');
        $inputs['user_id'] = $user->id;

        // $messages = [
        //     'mimes' => 'The :attribute must be a file of type: :values.',
        //     'max' => 'The :attribute must be maximum of: :values kb.',
        // ];

        $validator = Validator::make($inputs, [
            'photo' => 'required', // |image|mimetypes:image/jpeg,image/jpg,image/png
            'title' => 'required',
            'description' => 'required',
            'release_on' => 'required',
            'rating' => 'required',
            'price' => 'required',
            'country' => 'required',
            'genre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $imageData = $request->get('photo');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

        $inputs['photo'] = $fileName;
        if(Image::make($request->get('photo'))->save(public_path('storage/images/').$fileName)) {
            $inputs['user_id'] = Auth::user()->id;
            $film = Film::create($inputs);
            return response()->json(['success' => true, 'filminfo' => $film], 201);
        }
        // $film = Film::create($inputs);
        // return response()->json($inputs, 200);
        return response()->json(['success' => false], 200);
    }

    public function update(Request $request, Film $film)
    {
        $film->update($request->all());

        return response()->json($film, 200);
    }

    public function delete(Film $film)
    {
        $film->delete();

        return response()->json(null, 204);
    }

    public function filmsMine()
    {
        $films_mine = Film::where('user_id', Auth::user()->id)
               ->orderBy('created_at', 'desc')
               ->take(100)
               ->get();
        return response()->json(['success' => true, 'films_mine' => $films_mine], 200);
    }
}
