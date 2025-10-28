<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradeBoardgameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trade_boardgames')->insert([
            [
                'trade_id' => 1,
                'boardgame_id' => 3,
                'value' => 134.98
            ],
            [
                'trade_id' => 2,
                'boardgame_id' => 2,
                'value' => 157.32
            ],
            [
                'trade_id' => 2,
                'boardgame_id' => 1,
                'value' => 157.32
            ],
        ]);
        
    }
}
