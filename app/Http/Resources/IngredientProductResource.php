<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ingredient_id'                     => $this->id,
            'name'                              => $this->name,
            'ingredient_quantity_in_product'    => $this->pivot->quantity
        ];
    }
}
