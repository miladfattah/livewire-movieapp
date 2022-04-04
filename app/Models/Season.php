<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Season extends Model
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

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
