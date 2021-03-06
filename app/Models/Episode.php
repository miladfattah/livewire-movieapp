<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Episode extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function trailers()
    {
        return $this->morphMany(TrailerUrl::class, 'trailerable');
    }
    
}
