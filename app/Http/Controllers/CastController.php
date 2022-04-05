<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cast; 

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::orderBy('created_at' , 'desc')->paginate(8);
        return view('cast.index' , compact('casts'));
    }

    public function show(Cast $cast)
    {
        return view('cast.show' , compact('cast'));
    }
}
