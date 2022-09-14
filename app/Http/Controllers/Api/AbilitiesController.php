<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AbilityResource;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    public function index()
    {
        $permissions = auth()->user()->role->with('permissions')->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('title')
            ->toArray();

        return new AbilityResource($permissions);
    }
}
