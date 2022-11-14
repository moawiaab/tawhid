<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AbilityResource;
use App\Http\Resources\Admin\UserDataResource;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    public function index()
    {
        $permissions = auth()->user()->role->permissions
            ->pluck('title')->toArray();
        if (auth()->user()->status == 0) {
            $permissions = ['user_locked', 'dashboard_access'];
        }
        if (auth()->user()->account->status == 0) {
            $permissions = ['account_locked', 'dashboard_access'];
        }
        return [
            'data' => new AbilityResource($permissions),
            'user' => new UserDataResource(auth()->user())
        ];
    }
}
