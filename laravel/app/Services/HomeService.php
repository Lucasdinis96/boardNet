<?php

namespace App\Services;

use App\Repositories\TradeRepository;
use App\Repositories\BoardgameRepository;

class HomeService
{
    protected $tradeRepository;
    protected $boardgameRepository;

    public function __construct(
        TradeRepository $tradeRepository,
        BoardgameRepository $boardgameRepository
    ) {
        $this->tradeRepository = $tradeRepository;
        $this->boardgameRepository = $boardgameRepository;
    }

    public function getHomeData()
    {
        $trades = $this->tradeRepository->getLatestTrades(8);
        $boardgames = $this->boardgameRepository->getHomePage(4);

        return compact('trades', 'boardgames');
    }
}
