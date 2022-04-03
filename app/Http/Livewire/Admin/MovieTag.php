<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Tag ;
use App\Models\Movie ;

class MovieTag extends Component
{
    public $queryTag = '' ; 
    public $movie ; 
    public $tags = [] ;

    public function mount($movie)
    {
        $this->movie  = $movie ; 
    }

    public function updatedQueryTag()
    {
        $this->tags = Tag::search($this->queryTag)->get();

    }

    public function addTag($id)
    {
        
        // $tag = Tag::findOrFail($id);
        // $this->movie->tags()->attach($tag);
        // $this->reset('queryTag');
        $this->emit('addTag');
    }

    public function render()
    {
        return view('livewire.admin.movie-tag');
    }
}
