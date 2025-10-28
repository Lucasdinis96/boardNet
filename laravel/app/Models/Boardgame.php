<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boardgame extends Model
{
    use HasFactory;
    
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
