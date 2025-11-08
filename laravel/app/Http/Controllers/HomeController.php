<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Trade;

class HomeController extends Controller
{
    public function index (){
        $trades = Trade::with('user','boardgames')->latest()->limit(8)->get();
        $boardgames = Boardgame::limit(4)->get();

        return view('home', compact('boardgames','trades'));
    }
}
