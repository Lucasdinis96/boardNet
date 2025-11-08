<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request) {
        $term = $request->get('q','');
        $cities = City::with('state')
            ->where('name', 'like', "%{$term}%")
            ->orderBy('name')
            ->limit(10)
            ->get()
            ->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' =>"{$city->name} - {$city->state->uf}"
                ];
            });

        return response()->json($cities);
    }
}
