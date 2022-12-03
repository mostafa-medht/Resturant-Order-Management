<?php

namespace Database\Seeders;

use App\Models\IngredientProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert into products table
        $product = Product::create([
            'name' => 'Burger',
            'price' => 100
        ]);

        // Insert into ingredient_product table
        IngredientProduct::create([
            'product_id' => $product->id,
            'ingredient_id' => 1,
            'quantity' => 150,
        ]);

        IngredientProduct::create([
            'product_id' => $product->id,
            'ingredient_id' => 2,
            'quantity' => 30,
        ]);

        IngredientProduct::create([
            'product_id' => $product->id,
            'ingredient_id' => 3,
            'quantity' => 20,
        ]);

        // Insert into products table
        $product2 = Product::create([
            'name' => 'Pizza',
            'price' => 150
        ]);

        // Insert into ingredient_product table
        IngredientProduct::create([
            'product_id' => $product2->id,
            'ingredient_id' => 1,
            'quantity' => 180,
        ]);

        IngredientProduct::create([
            'product_id' => $product2->id,
            'ingredient_id' => 2,
            'quantity' => 70,
        ]);

        IngredientProduct::create([
            'product_id' => $product2->id,
            'ingredient_id' => 3,
            'quantity' => 25,
        ]);
    }
}
