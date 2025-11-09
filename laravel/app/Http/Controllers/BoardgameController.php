<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use Illuminate\Http\Request;

class BoardgameController extends Controller
{

    public function index() {
        $boardgames = Boardgame::paginate(8);
        return view('boardgames.index',compact('boardgames'));
    }

    public function show(Request $request, string $id) {

        $boardgame = Boardgame::findOrFail($id);
        $goBack = url()->previous();
        return view('boardgames.show', compact('boardgame', 'goBack'));
    }

}
