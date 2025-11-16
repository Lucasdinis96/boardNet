<?php

namespace App\Http\Controllers;

use App\Services\BoardgameService;
use Illuminate\Http\Request;

class BoardgameController extends Controller {
    
    protected $service;

    public function __construct(BoardgameService $service) {
        $this->service = $service;
    }

    public function index() {
        $boardgames = $this->service->listBoardgames();
        return view('boardgames.index', compact('boardgames'));
    }

    public function show(Request $request, string $id) {
        
        $boardgame = $this->service->getBoardgame((int) $id);
        $goBack = url()->previous();

        return view('boardgames.show', compact('boardgame', 'goBack'));
    }
}