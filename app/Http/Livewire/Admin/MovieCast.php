<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Cast ; 

class MovieCast extends Component
{
    public $queryCast = '' ; 
    public $movie ; 
    public $casts = [] ;

    public function mount($movie)
    {
        $this->movie  = $movie ; 
    }

    public function updatedQueryCast()
    {
        $this->casts = Cast::search($this->queryCast)->get();

    }

    public function addCast($id)
    {
        dd($this->movie);
        // $cast = Cast::findOrFail($id);
        // $this->movie->casts()->attach($cast);
        // $this->reset('queryCast');
        $this->emit('addCast');
    }

    public function render()
    {
        return view('livewire.admin.movie-cast');
    }
}
