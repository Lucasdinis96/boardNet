<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index() {
        $collections = Collection::with('user','boardgame');
        return view ('collections.index', compact('boardgames'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required'|'exists:users,id',
            'boardgame_id' => 'required'|'exists:boardgames,id',
        ]);

        Collection::create([
            'user_id' => $request->user_id,
            'boardgame_id' => $request->boardgame_id,
        ]);

        return redirect()->route('boardgames.index')->with('success', 'Adicionado a coleção');
    }

    public function remove(Collection $collection) {
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Removido da coleção');
    }
}
