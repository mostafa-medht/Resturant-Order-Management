<?php

namespace App\Services;

use App\Events\CheckIngredientStockAfterConsumedEvent;
use App\Http\Resources\IngredientResource;
use App\Mail\ChargeIngredientMail;
use App\Models\Ingredient;
use App\Models\Product;
use App\Traits\StandardRessponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class IngredientServices
{
    use StandardRessponse;

    /**
     * @return JsonResponse
     */
    public function getAllIngredients(): JsonResponse
    {
        return $this->returnResponse(IngredientResource::collection(Ingredient::all()));
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function storeIngrdient(array $data): JsonResponse
    {

        try {
            $ingredient = Ingredient::create([
                'name'              => $data['name'],
                'quantity'          => $data['quantity'],
                'level_of_stock'    => $data['level_of_stock'] ?? $data['quantity'],
            ]);

            Log::info('Store Ingredient: Ingredient with ID [ '. $ingredient->id .'] stored successfully.');

            return $this->returnSuccessResponse('Ingredient Stored Successfully');

        }catch (\Exception $exception){
            Log::error("Store Ingredient: can not add ingredient, ".$exception->getMessage());

            return $this->returnErrorResponse("Store Ingredient: can not add ingredient, please review log");
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function chargeIngredint(array $data): JsonResponse
    {
            try {
                $changeNotifyWithQty = true;

                $quantityInGram = $data['unit'] == 'kg' ? $data['quantity'] * 1000 : $data['quantity'];

                $ingredient = Ingredient::findOrFail($data['ingredient_id']);

                $newQantity = $ingredient->quantity + $quantityInGram;

                if ($newQantity < $ingredient->level_of_stock / 2)
                    $changeNotifyWithQty = false;

                $ingredient->update([
                    'quantity'                        => $changeNotifyWithQty,
                    'notify_with_ingredient_quantity' => $changeNotifyWithQty
                ]);

                Log::info('Charge Ingredient: Ingredient with ID [ '. $ingredient->id .'] charged successfully with [ '. $quantityInGram .' ] grams.');

                return $this->returnSuccessResponse('Ingredient Charged Successfully');

            }catch (\Exception $exception){
                Log::error("Charge Ingredient: can not charge ingredient, ".$exception->getMessage());

                return $this->returnErrorResponse("Charge Ingredient: can not charge ingredient, please review log");
            }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function showIngredint(array $data): JsonResponse
    {
            try {
                $ingredient = Ingredient::findOrFail($data['id']);

                return $this->returnResponse(new IngredientResource($ingredient));
            }catch (\Exception $exception){
                Log::error("Show Ingredient: can not show ingredient, ".$exception->getMessage());

                return $this->returnErrorResponse("Show Ingredient: can not show ingredient, please review log");
            }
    }

    /**
     * @param Ingredient $ingredient
     * @param float $consumedProductQtyFromStock
     * @return void
     */
    public function updateIngredientStock(Ingredient $ingredient, float $consumedProductQtyFromStock): void
    {
        $ingredient->update(['quantity' => $ingredient->quantity - $consumedProductQtyFromStock]);

        event(new CheckIngredientStockAfterConsumedEvent($ingredient));
    }

    /**
     * @param Product $product
     * @param float $orderProductQuantity
     * @return bool
     */
    public function checkIngredientAvailabilty(Product $product, float $orderProductQuantity): bool
    {
        foreach($product->ingredients()->get() as $ingredient){
            $ingredientProductQuantity = $ingredient->pivot->quantity;
            $ingredientStockQuantity = $ingredient->quantity;
            $consumedProductQtyFromStock = $orderProductQuantity * $ingredientProductQuantity;

            if ($consumedProductQtyFromStock > $ingredientStockQuantity){
                Log::error("Ingredient Stock: Ingredient with id [ ".$ingredient->id." ] for product id [ ".$product->id." ] out of stock");
                return false;
            }

        }
        return true;
    }
}
