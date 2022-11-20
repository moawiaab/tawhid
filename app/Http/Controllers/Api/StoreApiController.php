<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoresRequest;
use App\Http\Resources\StoresResource;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as FacadesRequest;

class StoreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('store_access'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        return StoresResource::collection(
            Store::advancedFilter()
                ->where('account_id', auth()->user()->account_id)
                ->filter(FacadesRequest::only('trashed'))
                ->paginate(request('rowsPerPage', 20))
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('store_create'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        return response([
            'meta' => [
                'products' =>  Product::when(
                    auth()->user()->account_id != 1,
                    function ($q) {
                        $q->where('status', 1)->orWhere('account_id', auth()->user()->account_id);
                    }
                )->get(['id', 'name'])
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresRequest $request)
    {
        $store = auth()->user()->account->stores()->create($request->validated());
        if ($store->save())
            $store->products()->syncWithPivotValues(
                $request->products,
                [
                    'user_id' => auth()->id(),
                    'account_id' => auth()->user()->account_id,
                    'created_at' => time(),
                ]
            );
        return  response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        if ($store->deleted_at) {
            $store->forceDelete();
        } else {
            $store->delete();
        }
    }

    public function destroyAll(Request $request)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        Store::whereIn('id', $request->items)->where('status', 1)->onlyTrashed()->forceDelete();
        Store::whereIn('id', $request->items)->delete('status', 1);


        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function addAll(Request $request)
    {
        // Store::insert($request[0]);
        foreach ($request[0] as $value) {
            $perm = new Store();
            $perm->name = $value['name'];
            $perm->details = $value['details'];
            $perm->status = 0;
            $perm->account_id = auth()->user()->account_id;
            $perm->save();
        }
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function restore(Store $item)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        $item->restore();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
