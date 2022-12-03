<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::create([
            'name' => 'Beef',
            'level_of_stock' => 10000,
            'quantity' => 10000,
        ]);

        Ingredient::create([
            'name' => 'Cheese',
            'level_of_stock' => 10000,
            'quantity' => 10000,
        ]);

        Ingredient::create([
            'name' => 'Onion',
            'level_of_stock' => 10000,
            'quantity' => 10000,
        ]);
    }
}
