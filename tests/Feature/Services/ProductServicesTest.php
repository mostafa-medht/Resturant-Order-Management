<?php

namespace Services;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ProductServicesTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function testGetAllProducts()
    {
        $response = $this->get('/api/v1/products')->assertOk();
    }

    public function testStoreProduct()
    {
        $this->withoutExceptionHandling();

        Ingredient::create([
            'name' => 'Test Name2',
            'quantity' => 100.0,
            'level_of_stock' => 300
        ]);

        $response = $this->post('/api/v1/products', [
            'name' => 'Test Name3',
            'price' => 150,
            'active' => 1,
            'ingredients'    => [
                ['ingredient_id' => 1, 'quantity' => 20],
            ]
        ]);

        $this->assertCount(1, Product::all());
    }
}
