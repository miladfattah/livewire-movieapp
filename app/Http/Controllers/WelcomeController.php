<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie ;
use App\Models\Episode ;
use App\Models\Serie ;
class WelcomeController extends Controller
{
    public function __invoke(){
        $movies = Movie::orderBy('updated_at')->take(8)->get();
        $episodes = Episode::orderBy('created_at')->take(8)->get();
        $series = Serie::orderBy('created_at')->take(8)->get();
        return view('welcome' , compact('movies' , 'episodes' , 'series'));
    }
}
