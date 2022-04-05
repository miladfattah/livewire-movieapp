<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie; 
use App\Models\Season; 
use App\Models\Episode; 

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

    public function seasonShow(Serie $serie , Season $season)
    {
        $latest = Season::orderBy('created_at' , 'desc')->take(9)->get();
        return view('serie.season.show' , compact('serie' , 'season' , 'latest'));
    }

    public function showEpisode(Episode $episode)
    {
        $latest = Episode::orderBy('created_at' , 'desc')->take(9)->get();
        return view('episode.show' , compact('episode' , 'latest'));
    }
}
