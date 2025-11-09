<?php

namespace App\Http\Controllers;

use App\Models\Boardgame;
use App\Models\Trade;
use App\Models\TradeItens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{

    public function index() {
        $trades = Trade::paginate(10);
        return view ('trades.index', compact('trades'));
    }

    public function show(Request $request, string $id) {
        
        $trade = Trade::findOrFail($id);
        $backUrl = $request->back ?? route('home');

        return view ('trades.show', compact('trade', 'backUrl'));
    }

    public function create() {
        $boardgames = Boardgame::orderBy('title')->get();
        return view ('trades.create', compact('boardgames'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'boardgames' => 'required|array',
            'boardgames.*.id' => 'required|exists:boardgames,id',
            'boardgames.*.value' => 'required|numeric|min:0',
        ]);

        $trade = Trade::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->boardgames as $bg) {
            TradeItens::create([
                'trade_id' => $trade->id,
                'boardgame_id' => $bg['id'],
                'value' => $bg['value'],
            ]);
        }
        return redirect()->route('myTrades');
    }

    public function edit(Trade $trade) {

        
        $boardgames = Boardgame::all();

        return view ('trades.edit',compact('trade', 'boardgames'));
    }

    public function update(Request $request, Trade $trade) {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'boardgames' => 'required|array',
            'boardgames.*.id' => 'required|exists:boardgames,id',
            'boardgames.*.value' => 'nullable|numeric|min:0'
        ]);

        $trade->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
      
        $syncData = [];

        foreach ($request->boardgames as $bg) {
            if(!empty($bg['id'])) {
                $syncData[$bg['id']] = ['value' => $bg['value'] ?? null];
            }
        }
        
        $trade->boardgames()->sync($syncData);
        return redirect()->route('myTrades');
    }

    public function destroy(Trade $trade) {
        $trade->delete();
        return redirect()->route('myTrades');
    }

    public function myTrades() {
        $trades = Trade::with(['boardgames', 'user.city'])
            ->where('user_id', Auth::id())
            
            ->get();

        return view('users.trade', compact('trades'));
    }

    public function detachBoardgame(Trade $trade, Boardgame $boardgame) {
        
        $trade->boardgames()->detach($boardgame->id);
        return back()->with('success', 'Jogo removido do anúncio.');
    }
}
