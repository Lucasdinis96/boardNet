<?php

namespace App\Repositories;

use App\Models\Boardgame;

class BoardgameRepository {
    
    public function getIndexPage() {
        return Boardgame::orderBy('title', 'asc')->paginate(8);
    }

    public function getHomePage(int $limit = 4) {
        return Boardgame::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function find(int $id): Boardgame {
        return Boardgame::findOrFail($id);
    }
}