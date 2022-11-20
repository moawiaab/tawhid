<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name'       => $this->name ?? '',
            'details'    => $this->details ?? '',
            'deletable'  => $this->account_id == auth()->user()->account_id && $this->status == 0 ?? false,
            'editable'   => $this->account_id == auth()->user()->account_id ?? false,
            'category'   => $this->category ? $this->category->name : 'لا يوجد قسم',
            'status'     => $this->status
                ? 'قسم عام' . ' - ' . ($this->account->name ?? '') ?? ''
                : 'قسم خاص'  . ' - ' . ($this->account->name ??'') ?? '',
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y') : '',
            'deleted_at' => $this->deleted_at ?? '',
        ];
    }
}
