<?php

namespace App\Listeners;

use App\Services\OrderServices;
use App\Services\ProductServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateIngredientStockListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public OrderServices $orderServices){}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->orderServices->checkOrderProductsAvailabilty($event->order, new ProductServices());
    }
}
