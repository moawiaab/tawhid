<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStoreResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->product->name ?? '',
            'number'     => $this->number ?? 0,
            'category'   => $this->product->category->name ?? '',
            'price'      => $this->product->price ?? 0,
            'amount'     => $this->product->amount ?? 0,
            'gain'       => $this->gain ?? 0
        ];
    }
}
