<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id ?? '',
            'name' => $this->name ?? '',
            'done'    => $this->status ?? '',
            'start_date' => $this->start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'status' => $this->status ? 'مفتوح' : 'مغلق',
            'gain' => $this->gain ?? '',
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y') : '',
        ];
    }
}
