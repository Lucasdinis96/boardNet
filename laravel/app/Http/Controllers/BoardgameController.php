<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use Illuminate\Http\Request;

class BoardgameController extends Controller
{

    public function index() {
        $boardgames = Boardgame::paginate(10);
        return view('boardgames.index',compact('boardgames'));
    }

    public function create() {
        return view('boardgames.create');
    }

    public function store(Request $request) {
        Boardgame::create($request->all());
        return redirect()->route('boardgames.index');
    }

    public function edit(Boardgame $boardgame) {
        return view ('boardgames.edit',compact('boardgame'));
    }

    public function update(Request $request, Boardgame $boardgame) {
        $boardgame->update($request->all());
        return redirect()->route('boardgame.index');
    }

    public function destroy(Boardgame $boardgame) {
        $boardgame->delete();
        return redirect()->route('boardgames.index');
    }
}
