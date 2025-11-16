<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\CreateTradeRequest;
use App\Http\Requests\Trade\UpdateTradeRequest;
use App\Models\Boardgame;
use App\Models\Trade;
use App\Services\TradeService;
use App\Http\Resources\TradeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TradeApiController extends Controller {
    protected TradeService $tradeService;

    public function __construct(TradeService $tradeService) {
        $this->tradeService = $tradeService;
    }

    public function index(): JsonResponse {
        $trades = $this->tradeService->listTrades();
        return response()->json([
            'status' => 'success',
            'data' => TradeResource::collection($trades)
        ]);
    }

    public function show(string $id): JsonResponse {
        $trade = $this->tradeService->showTrade($id);

        if ($trade) {
            return response()->json([
                'status' => 'error',
                'message' => 'Troca não encontrada'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $trade
        ]);
    }
}
