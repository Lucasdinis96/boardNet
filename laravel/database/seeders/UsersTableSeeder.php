<?php

namespace Database\Seeders;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert(
            [
                'name' => 'Test User 01',
                'email' => 'test01@example.com',
                'password' => bcrypt('teste01'),
                'birthdate' => Carbon::parse('2003-09-12'),
                'city' => City::inRandomOrder()->first()->id
            ],
            [
                'name' => 'Test User 02',
                'email' => 'test02@example.com',
                'password' => bcrypt('teste01'),
                'birthdate' => Carbon::parse('2003-09-12'),
                'city' => City::inRandomOrder()->first()->id
            ],
            [
                'name' => 'Test User 03',
                'email' => 'test03@example.com',
                'password' => bcrypt('teste01'),
                'birthdate' => Carbon::parse('2003-09-12'),
                'city' => City::inRandomOrder()->first()->id
            ],
            
        
        );
    }
}
