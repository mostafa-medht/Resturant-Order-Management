<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert into orders table
        $order = Order::create([
            'billing_email' => 'email@email.com',
            'billing_name' => 'Fake Order',
            'billing_total' => 250,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => 1,
            'quantity' => 1,
        ]);

        OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => 2,
            'quantity' => 1,
        ]);

        // Insert into orders table
        $order2 = Order::create([
            'billing_email' => 'another@another.com',
            'billing_name' => 'Fake Order 2',
            'billing_total' => 650,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id' => $order2->id,
            'product_id' => 1,
            'quantity' => 2,
        ]);

        OrderProduct::create([
            'order_id' => $order2->id,
            'product_id' => 2,
            'quantity' => 3,
        ]);

        // Insert into orders table
        $order3 = Order::create([
            'billing_email' => 'fake@fake.com',
            'billing_name' => 'Fake Order 3',
            'billing_total' => 550,
        ]);

        // Insert into order_product table
        OrderProduct::create([
            'order_id' => $order3->id,
            'product_id' => 2,
            'quantity' => 1,
        ]);

        OrderProduct::create([
            'order_id' => $order3->id,
            'product_id' => 1,
            'quantity' => 4,
        ]);
    }
}
