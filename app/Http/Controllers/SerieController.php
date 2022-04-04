<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie; 

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::orderBy('created_at' , 'desc')->paginate(5);
        return view('serie.index' , compact('series'));
    }

    public function show(Serie $serie)
    {
        $latest = Serie::orderBy('created_at' , 'desc')->take(9)->get();
        return view('serie.show' , compact('serie' , 'latest'));
    }
}
