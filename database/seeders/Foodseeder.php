<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Foods;

class Foodseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Foods::create([
            'id' => 1, 'name' => 'frozen yogurt', 'calories' => 100,
            'fat' => 30, 'carbs' => 30, 'protein' => 4, 'iron' => 3
        ]);
        Foods::create([
            'id' => 2, 'name' => 'apple pie', 'calories' => 200,
            'fat' => 40, 'carbs' => 50, 'protein' => 4, 'iron' => 3
        ]);
    }
}
