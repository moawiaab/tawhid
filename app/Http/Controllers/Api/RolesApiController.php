<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class RolesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');

        return  RoleResource::collection(
            auth()
                ->user()
                ->account
                ->roles()
                ->with(['permissions'])
                ->advancedFilter()
                ->paginate(request('rowsPerPage', 10))
        );
    }

    public function store(StoreRoleRequest $request)
    {
        $role =  auth()
            ->user()
            ->account
            ->roles()->create($request->validated());
        $role->permissions()->sync($request->permissions);
        $role->permissions()->syncWithoutDetaching(1);

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');

        return response([
            'meta' => [
                'permissions' => Permission::where('id', '>', 1)->when(auth()->user()->account_id != 1, function ($q) {
                    $q->where('status', 1);
                })->get(['id as value', 'details as label']),
            ],
        ]);
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');

        return [
            'data' => new RoleResource($role),
            'meta' => [
                'permissions' => $role->permissions->transform(fn ($pram) => [
                    'id' => $pram->id,
                    'name' => $pram->details,
                ]),
                'users' => $role->users->transform(fn ($pram) => [
                    'id' => $pram->id,
                    'name' => $pram->name,
                ])
            ]
        ];
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->permissions()->sync($request->permissions);
        $role->permissions()->syncWithoutDetaching(1);

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');

        return response([
            'data' => new RoleResource($role),
            'meta' => [
                'permissions' => Permission::where('id', '>', 1)->when(auth()->user()->account_id != 1, function ($q) {
                    $q->where('status', 1);
                })->get(['id as value', 'details as label']),
                'roles' => $role->permissions->transform(fn ($role) => [
                    $role->id
                ]),
            ],
        ]);
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');

        $role->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
