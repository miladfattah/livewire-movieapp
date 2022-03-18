<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use App\Models\Cast;
use App\Models\Serie;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $movies = Movie::count();
        $casts = Cast::count();
        $series = Serie::count();
        return view('admin.index' ,
            compact(
                'users' , 
                'movies' , 
                'casts' , 
                'series'
            )
        );
    }
}
