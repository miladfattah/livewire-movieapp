<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('created_at' , 'desc')->paginate(8);
        return view('movie.index' , compact('movies'));
    }   

    public function show(Movie $movie)
    {
        $latest = Movie::orderBy('created_at' , 'desc')->take(9)->get();
        return view('movie.show' , compact('movie' , 'latest'));
    }
}
