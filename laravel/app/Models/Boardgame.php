<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boardgame extends Model
{
    protected $table = 'boardgames';
    protected $fillable = [
        'title',
        'publisher',
        'players',
        'playtime',
        'age_range',
        'description',
    ];
}
