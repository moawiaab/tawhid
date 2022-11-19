<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name ?? '',
            'email'      => $this->email ?? '',
            'phone'      => $this->phone ?? '',
            'role_id'    => $this->role_id ?? '',
            // 'online'     => $this->last_activity ?? '',
            'role'       => $this->role ? $this->role->title : 'لا يوجد قسم',
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y') : '',
            'deleted_at' => $this->deleted_at ?? '',
        ];
    }
}
