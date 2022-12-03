<?php

namespace Services;

use App\Models\Ingredient;
use App\Services\IngredientServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

class IngredientServicesTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function testStoreIngrdient()
    {
        $response = $this->post('/api/v1/ingredients', [
            'name' => 'Test Name2',
            'quantity' => 500,
            'level_of_stock' => 300,
        ]);

        $this->assertCount(1, Ingredient::all());
    }


    public function testUpdateIngredientStock()
    {
        Event::fake();

        $ingredient = Ingredient::create([
            'name' => 'Test Name2',
            'quantity' => 100.0,
            'level_of_stock' => 300
        ]);

        $ingredientService = new IngredientServices();

        $ingredientService->updateIngredientStock($ingredient, 50.0);

        $this->assertSame(50.0, $ingredient->quantity);
    }

    public function testGetAllIngredients()
    {
        $response = $this->get('/api/v1/ingredients')->assertOk();
    }
}
