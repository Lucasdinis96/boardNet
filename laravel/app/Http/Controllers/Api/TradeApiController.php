<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\CreateTradeRequest;
use App\Http\Requests\Trade\UpdateTradeRequest;
use App\Models\Boardgame;
use App\Models\Trade;
use App\Services\TradeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TradeApiController extends Controller
{
    protected TradeService $tradeService;

    public function __construct(TradeService $tradeService) {
        $this->tradeService = $tradeService;
    }

    public function index(): JsonResponse {
        $trades = $this->tradeService->listTrades();
        return response()->json([
            'status' => 'success',
            'data' => $trades
        ]);
    }

    public function show(string $id): JsonResponse {
        $trade = $this->tradeService->showTrade($id);

        if (!$trade) {
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

    public function store(CreateTradeRequest $request): JsonResponse
    {
        $trade = $this->tradeService->createTrade($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Troca criada com sucesso',
            'data' => $trade
        ], 201);
    }

    public function update(UpdateTradeRequest $request, Trade $trade): JsonResponse {

        if ($trade->user_id !== Auth::id()) {
            return response()->json(['message' => 'Você não tem permissão para alterar esta troca.'], 403);
        }
        
        $updated = $this->tradeService->updateTrade($trade, $request->validated());

        

        return response()->json([
            'status' => 'success',
            'message' => 'Troca atualizada com sucesso',
            'data' => $updated
        ]);
    }

    public function destroy(Trade $trade): JsonResponse {

        if ($trade->user_id !== auth()->id()) {
            return response()->json(['message' => 'Você não tem permissão para deletar esta troca.'], 403);
        }

        $this->tradeService->deleteTrade($trade);

        return response()->json([
            'status' => 'success',
            'message' => 'Troca excluída com sucesso'
        ]);
    }

    public function myTrades(): JsonResponse {
        
        
        $trades = $this->tradeService->getUserTrades();

        return response()->json([
            'status' => 'success',
            'data' => $trades
        ]);
    }

    public function detachBoardgame(Trade $trade, Boardgame $boardgame): JsonResponse {

        if ($trade->user_id !== auth()->id()) {
            return response()->json(['message' => 'Você não tem permissão para deletar esta troca.'], 403);
        }

        $this->tradeService->removeBoardgame($trade, $boardgame);

        return response()->json([
            'status' => 'success',
            'message' => 'Jogo removido do anúncio'
        ]);
    }
}
