<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'ref_number'        => $this->id,
            'name'              => $this->name,
            'level_of_stock'    => $this->level_of_stock,
            'quantity'          => $this->quantity,
            'notify_quantity'   => $this->notify_with_ingredient_quantity,
            'create_at'         => $this->created_at->format('Y m d h:m:s')
        ];
    }
}
