<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{

    public function index() {
        $boardgames = Auth::user()->boardgames()->withPivot('id')->paginate(8);
        return view ('users.collection', compact('boardgames'));
    }

    public function add(Request $request) {
        $request->validate([
            'boardgame_id' => 'required|exists:boardgames,id',
        ]);

        Collection::create([
            'user_id' => Auth::id(),
            'boardgame_id' => $request->boardgame_id,
        ]);

        return back();
    }

    public function remove(Collection $collection) {
        $collection->delete();

        return back();
    }
}
