<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        $movies = $genre->movies()->orderBy('created_at' , 'desc')->paginate(8);
        return view('genre.show' , compact('movies' , 'genre'));
    }
}
