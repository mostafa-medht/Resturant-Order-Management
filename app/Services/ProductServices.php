<?php

namespace App\Services;

use App\Http\Resources\IngredientResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Ingredient;
use App\Models\IngredientProduct;
use App\Models\Order;
use App\Models\Product;
use App\Traits\StandardRessponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class ProductServices
{
    use StandardRessponse;

    /**
     * @return JsonResponse
     */
    public function getAllProducts(): JsonResponse
    {
        return $this->returnResponse(ProductResource::collection(Product::all()));
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function storeProduct(array $data): JsonResponse
    {
        try {
            // Create Product
            $product = Product::create([
                'name'     => $data['name'],
                'price'    => $data['price'],
                'active'   => $data['active'] ?? 1,
            ]);

            // Insert into ingredient_product
            foreach ($data['ingredients'] as $ingredient){
                IngredientProduct::create([
                    'product_id'    => $product->id,
                    'ingredient_id' => $ingredient['ingredient_id'],
                    'quantity'      => $ingredient['quantity'],
                ]);
            }

            Log::info('Store Product: Product with ID ['. $product->id .'] stored successfully.');

            return $this->returnSuccessResponse('Product Stored Successfully');

        }catch (\Exception $exception){
            Log::error("Store Product: can not add product, ".$exception->getMessage());

            return $this->returnErrorResponse("Store Product: can not add product, please review log");
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function showProduct(array $data): JsonResponse
    {
            try {
                $product = Product::findOrFail($data['id']);

                return $this->returnResponse(new ProductResource($product));
            }catch (\Exception $exception){
                Log::error("Show Product: can not show product, ".$exception->getMessage());

                return $this->returnErrorResponse("Show Product: can not show product, please review log");
            }
    }

    /**
     * @param Product $product
     * @param float $orderProductQuantity
     * @param IngredientServices $ingredientServices
     * @return bool
     */
    public function checkProductIngredientsAvailabilty(Product $product, float $orderProductQuantity, IngredientServices $ingredientServices)
    {
        foreach($product->ingredients()->get() as $ingredient){
            $ingredientProductQuantity = $ingredient->pivot->quantity;
            $consumedProductQtyFromStock = $orderProductQuantity * $ingredientProductQuantity;

            $ingredientServices->updateIngredientStock($ingredient, $consumedProductQtyFromStock);
        }
    }

    /**
     * @param $orderProductsArray
     * @param IngredientServices $ingredientServices
     * @return bool
     */
    public function checkProductsAvailabilty($orderProductsArray, IngredientServices $ingredientServices)
    {
        $available = true;

//        $productIds = array_column($orderProductsArray, 'product_id');
//        $products  = Product::whereIn('id', $productIds)->get();

        foreach($orderProductsArray as $item){
            $product = Product::findOrFail($item['product_id']);
            if (! $ingredientServices->checkIngredientAvailabilty($product, $item['quantity'])){
                $available = false;
            }
        }

        return $available;
    }
}
