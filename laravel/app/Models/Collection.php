<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    
    protected $table = 'collections';
    protected $fillable = [
        'user_id',
        'boardgame_id',
    ];

    public function user() {
        return $this->belongsToMany(User::class);
    }

    public function boardgame() {
        return $this->belongsToMany(Boardgame::class);
    }
}
