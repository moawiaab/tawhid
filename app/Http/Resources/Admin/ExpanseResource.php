<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpanseResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'         => $this->id ?? '',
            'name'       => $this->name ?? '',
            'stage'      => $this->stage->name ?? '',
            'num'        => $this->items->count(),
            'items'      => $this->items->take(10)->transform(fn ($e) => [
                'id'         => $e->id ?? '',
                'amount'     => $e->amount ?? '',
                'details'    => $e->details ?? '',
                'created_at' => $e->created_at->format('d-m-Y') ?? '',
                'user'       => $e->user->name ?? '',
            ]) ?? [],
            'status'     => $this->status,
            'user'       => $this->user->name ?? '',
            'amount'     => $this->amount ?? '',
            'expanses'   => $this->expanses ?? '',
            'new_amount' => $this->amount -  $this->expanses?? 0,
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y') : '',
            'deleted_at' => $this->deleted_at ?? '',
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-m-Y') : '',
        ];
    }
}
