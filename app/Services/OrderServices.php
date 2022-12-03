<?php

namespace App\Services;

use App\Events\NewOrderPlacedEvent;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\StandardRessponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderServices
{
    use StandardRessponse;

    /**
     * @return JsonResponse
     */
    public function getAllOrders(): JsonResponse
    {
        return $this->returnResponse(OrderResource::collection(Order::all()));
    }

    /**
     * @param array $data
     * @param ProductServices $productServices
     * @return JsonResponse
     */
    public function storeOrder(array $data, ProductServices $productServices): JsonResponse
    {
        try {

            if (!$productServices->checkProductsAvailabilty($data['products'], new IngredientServices())){
                Log::error("Store Order: Can not place order, some product out of stock");
                return $this->returnErrorResponse("Store Order: Can not place order, some product out of stock, please review log") ;
            }

            // Create Order
            $order = Order::create([
                'billing_name'     => $data['billing_name'],
                'billing_email'    => $data['billing_email'],
                'billing_total'    => $data['billing_total'] ?? 0,
            ]);

            // Insert into order_product
            foreach ($data['products'] as $product){
                OrderProduct::create([
                    'order_id'      => $order->id,
                    'product_id'    => $product['product_id'],
                    'quantity'      => $product['quantity'],
                ]);
            }

            event(new NewOrderPlacedEvent($order));

            Log::info('Store Order: Order with ID ['. $order->id .'] stored successfully.');

            return $this->returnSuccessResponse('Order Stored Successfully');

        }catch (\Exception $exception){
            Log::error("Store Order: Can not add order, ".$exception->getMessage());

            return $this->returnErrorResponse("Store Order: Can not add order, please review log");
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function showOrder(array $data): JsonResponse
    {
            try {
                $order = Order::findOrFail($data['id']);

                return $this->returnResponse(new OrderResource($order));
            }catch (\Exception $exception){
                Log::error("Show Order: can not show order, ".$exception->getMessage());

                return $this->returnErrorResponse("Show Order: can not show order, please review log");
            }
    }

    /**
     * @param $order
     * @param ProductServices $productServices
     * @return bool
     */
    public function checkOrderProductsAvailabilty($order, ProductServices $productServices): bool
    {
        foreach($order->products()->get() as $product){
            if (! $productServices->checkProductIngredientsAvailabilty($product, $product->pivot->quantity, new IngredientServices())){
                Log::error("Order Placed: Can not place order with id [ ".$order->id." ], product with id [ ".$product->id." ] out of stock");
                return false;
            }
        }
        return true;
    }

}
