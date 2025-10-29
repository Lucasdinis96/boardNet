<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{

    public function index() {
        $trades = Trade::paginate(10);
        return view ('trades.index', compact('trades'));
    }

    public function create() {
        return view ('trades.create');
    }

    public function store(Request $request) {
        Trade::create($request->all());
        return redirect()->route('trades.index');
    }

    public function edit(Trade $trade) {
        return view ('trades.edit',compact('trade'));
    }

    public function update(Request $request, Trade $trade) {
        $trade->update($request->all());
        return redirect()->route('trades.index');
    }

    public function destroy(Trade $trade) {
        $trade->delete();
        return redirect()->route('trades.index');
    }
}
