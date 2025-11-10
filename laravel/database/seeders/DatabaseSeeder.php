<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
            UsersTableSeeder::class,
            BoardgameTableSeeder::class,
            CollectionTableSeeder::class,
            TradeTableSeeder::class,
            TradeItensTableSeeder::class
        ]);
    }
}
