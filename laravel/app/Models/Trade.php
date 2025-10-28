<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;
    
    protected $table = 'trades';
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
