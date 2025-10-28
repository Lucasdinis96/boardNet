<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trades')->insert([
            [
                'id' => 1,
                'title' => 'Abrindo espaço',
                'description' => 'Preciso abrir espaço, então desejo uma nova
                casa para estes camaradas',
                'user_id' => 2
            ],
            [
                'id' => 2,
                'title' => 'Vendendo memórias',
                'description' => 'Vou me mudar e não posso leva-los comigo, estão 
                em boas condições, usados moderadamente',
                'user_id' => 1
            ],
        ]);
    }
}
