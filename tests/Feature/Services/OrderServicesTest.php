<?php

namespace Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderServicesTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllOrders()
    {
        $response = $this->get('/api/v1/orders')->assertOk();
    }

    public function testStoreOrderIntoDataBase()
    {
        Event::fake();

        $product = Product::create([
            'name' => 'Test Name3',
            'price' => 150,
            'active' => 1,
            'ingredients'    => [
                ['ingredient_id' => 1, 'quantity' => 20],
                ['ingredient_id' => 2, 'quantity' => 30],
            ]
        ]);

        $response = $this->post('/api/v1/orders', [
            'billing_name' => 'Test Name1',
            'billing_email' => 'test@test.com',
            'billing_total' => 300,
            'products'    => [
                ['product_id' => $product->id, 'quantity' => 2],
            ]
        ]);

        $this->assertCount(1, Order::all());
    }

}
