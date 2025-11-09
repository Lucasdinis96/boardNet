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
        $user = auth()->user();
        $user->boardgames()->syncWithoutDetaching([$request->boardgame_id]);

        return $request->expectsJson() ? response()->json(['status' => 'added'])
        : back();
    }

    public function remove($boardgameId, Request $request) {
        $user = auth()->user();
        $user->boardgames()->detach($boardgameId);

        return $request->expectsJson() ? response()->json(['status' => 'removed']) : back();
    }
}
