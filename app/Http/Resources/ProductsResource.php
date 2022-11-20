<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'name'       => $this->name,
            'details'    => $this->details,
            'deletable'  => ($this->account_id == auth()->user()->account_id
                && $this->status == 0
                && $this->products->where('account_id', auth()->user()->account_id)->sum('number') <= 0) ?? false,
            'editable'   => $this->account_id == auth()->user()->account_id,
            'number'     => $this->products->where('account_id', auth()->user()->account_id)->sum('number') ?? 0,
            'items'      => ProductStoreResource::collection($this->products->where('account_id', auth()->user()->account_id)) ?? [],
            'category'   => $this->category ? $this->category->name : 'لا يوجد قسم',
            'status_label' => $this->status
                ? 'منتج عام' . ' - ' . $this->account->name ?? ''
                : 'منتج خاص'  . ' - ' . $this->account->name ?? '',
            'status'  => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y') : '',
            'deleted_at' => $this->deleted_at ?? '',
        ];
    }
}
