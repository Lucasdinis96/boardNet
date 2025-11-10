<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository {

    public function search(string $term, int $limit = 10) {
        return City::with('state')
            ->where('name', 'like', "%{$term}%")
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }
}