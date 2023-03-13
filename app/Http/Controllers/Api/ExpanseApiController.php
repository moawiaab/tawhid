<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpanseRequest;
use App\Http\Requests\StoreExpanseRequest;
use App\Http\Requests\UpdateExpanseRequest;
use App\Http\Resources\Admin\AmountResources;
use App\Http\Resources\Admin\ExpanseResource;
use App\Models\Expanse;
use App\Models\ExpanseItem;
use App\Models\PrivateLocker;
use App\Models\Stage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ExpanseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expanse_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return ExpanseResource::collection(auth()->user()->account->expanses()->advancedFilter()->paginate(request('limit', 10)));
    }

    public function store(StoreExpanseRequest $request)
    {
        $data = [
            'user_id'  => auth()->id(),
            'status'   => 1,
            'expanses' => 0,
            'stage_id' => Stage::where('status', 1)->first()->id
        ];
        $expanse = auth()->user()->account->expanses()->create($request->validated() + $data);
        return (new ExpanseResource($expanse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('expanse_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response([
            'meta' => [
                'stages' => auth()->user()->account->stages()->get(['id', 'name']),
            ],
        ]);
    }

    public function show(Expanse $expanse)
    {
        abort_if(Gate::denies('expanse_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $items =  new AmountResources(ExpanseItem::with(['user', 'admin'])->advancedFilter()->expanse($expanse->id));
        return [
            'data' =>  new ExpanseResource($expanse->load(['user', 'sh', 'stage'])),
            'items'  => $items,

        ];
    }

    public function update(UpdateExpanseRequest $request, Expanse $expanse)
    {
        $expanse->update($request->validated());
        return (new ExpanseResource($expanse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Expanse $expanse)
    {
        abort_if(Gate::denies('expanse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return response([
            'data' => $expanse,
            'meta' => ['stages' => auth()->user()->account->stages()->get(['id', 'name'])],
        ]);
    }

    public function destroy(Expanse $expanse)
    {
        abort_if(Gate::denies('expanse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $expanse->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function done(ExpanseItem $expanse)
    {
        $exp = Expanse::find($expanse->exp_id);
        if (!$expanse->prive_id) {
            $privateLocker = PrivateLocker::where('user_id', $expanse->user_id)->first();
        } else {
            $privateLocker = PrivateLocker::find($expanse->prive_id);
        }
        $privateLocker->amount -= $expanse->amount;
        $privateLocker->save();
        $exp->expanses += $expanse->amount;
        $exp->save();
        $expanse->status = 0;
        $expanse->admin_id = auth()->id();

        if ($expanse->save()) {
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            throw new Exception("لم يتم التراجع بنجاح حاول مرة اخرة لاحقا");
        }
    }

    public function amount(ExpanseRequest $request, Expanse $expanse)
    {
        if (!auth()->user()->locker) {
            throw new Exception("افتح الخزينة الشخصية من فضلك", 1);
        }
        if (!$expanse->prive_id) {
            $privateLocker = PrivateLocker::where('user_id', $expanse->user_id)->first();
        } else {
            $privateLocker = PrivateLocker::find($expanse->prive_id);
        }
        $item = new ExpanseItem();
        $item->account_id   = auth()->user()->account_id;
        $item->user_id      = auth()->user()->id;
        $item->status       = 1;
        $item->locker_id     = auth()->user()->locker->id;
        $item->amount       = $request->amount;
        $item->details      = $request->details;
        $item->expanse_id   = $expanse->id;

        $privateLocker->amount -= $request->amount;
        $expanse->expanses += $request->amount;

        if ($item->save()) {
            $expanse->save();
            $privateLocker->save();
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            throw new Exception(" لم تتم العملية بنجاح حاول مرة اخرة لاحقا");
        }
    }

    public function toggle(Expanse $expanse)
    {
        $expanse->status = !$expanse->status;
        if ($expanse->save()) {
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            throw new Exception("لم يتم التراجع بنجاح حاول مرة اخرة لاحقا");
        }
    }
}
