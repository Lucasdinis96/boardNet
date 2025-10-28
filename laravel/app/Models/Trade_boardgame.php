<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade_board extends Model
{

    use HasFactory;
    
    protected $table = 'trade_boardgames';
    protected $fillable = [
        'trade_id',
        'boardgame_id',
        'value'
    ];

    public function boardgame () {
        return $this->belongsToMany(Boardgame::class);
    }

    public function trade() {
        return $this->belongsToMany(Trade::class);
    }
}
