<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Movie ;
class Search extends Component
{

    public $showSearchModal = false ;
    public $search = '' ;
    public $modelSearchResults = [];
    public function showSearch()
    {
        $this->showSearchModal = true ;
    }

    public function updatedSearch()
    {
        $this->modelSearchResults = Movie::search($this->search)->get();
    }

    public function closeSearchModal()
    {
        $this->reset();
    }
    public function render()
    {
        return view('livewire.search');
    }
}
