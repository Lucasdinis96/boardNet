<?php

namespace App\Http\Controllers\Api;

use App\Services\CollectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionApiController extends Controller {
    protected $service;

    public function __construct(CollectionService $service) {
        $this->service = $service;
    }

    public function index() {
        $boardgames = $this->service->getUserCollection(Auth::user());
        return response()->json($boardgames);
    }

    public function add(Request $request) {
        $user = Auth::user();
        $response = $this->service->addBoardgame($user, $request->boardgame_id);

        return $request->expectsJson() ? response()->json($response) : back();
    }

    public function remove($boardgameId, Request $request) {
        $user = Auth::user();
        $response = $this->service->removeBoardgame($user, $boardgameId);

        return $request->expectsJson() ? response()->json($response) : back();
    }
}