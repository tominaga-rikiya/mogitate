<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_seasons', 'product_id', 'season_id');
    }
}

