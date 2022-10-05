<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return UserResource::collection(
            auth()
                ->user()
                ->account
                ->users()
                ->with(['role', 'account'])
                ->advancedFilter()
                ->paginate(request('rowsPerPage', 20))
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = auth()->user()->account->users()->create($request->validated());
        // $user->roles()->sync($request->input('roles.*.id', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'roles' =>
                auth()
                    ->user()
                    ->account
                    ->roles()->get(['id', 'title']),
            ],
        ]);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new UserResource($user->load(['role', 'account'])),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new UserResource($user->load(['role', 'account'])),
            'meta' => [
                'roles' => auth()
                    ->user()
                    ->account
                    ->roles()->get(['id', 'title']),
            ],
        ]);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function toggle(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->status = !$user->status;
        if (auth()->id() == $user->id)
            throw new Exception('لا يمكنك قفل حسابك');
        elseif (auth()->user()->role->id > 2)
            throw new Exception('هذا الحاسب مدير لفرع لا يمكنك قفله');
        else
            $user->save();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
