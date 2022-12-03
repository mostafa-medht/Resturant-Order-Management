<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price'             => $this->price,
            'active'            => $this->active,
            'ingredients'       => IngredientProductResource::collection($this->ingredients),
            'create_at'         => $this->created_at->format('Y m d h:m:s')
        ];
    }
}
