<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Season; 
class SeasonIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.season-index' , [
            'seasons' => Season::paginate()
        ]);
    }
}
