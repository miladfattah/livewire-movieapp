<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        $latest = Movie::orderBy('created_at' , 'desc')->take(9)->get();
        return view('movie.show' , compact('movie' , 'latest'));
    }
}
