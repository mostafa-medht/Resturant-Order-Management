<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'billing_name'     => $this->billing_name,
            'billing_email'    => $this->billing_email,
            'billing_total'    => $this->billing_total,
            'products'         => OrderProductResource::collection($this->products),
            'create_at'        => $this->created_at->format('Y m d h:m:s')
        ];
    }
}
