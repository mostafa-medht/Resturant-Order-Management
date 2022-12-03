<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'product_id'            => $this->id,
            'product_name'          => $this->name,
            'product_price'         => $this->price,
            'product_quantity'      => $this->pivot->quantity,
            'total_product_price'   => $this->pivot->quantity * $this->price,
        ];
    }
}
