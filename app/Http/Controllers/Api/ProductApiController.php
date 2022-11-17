<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Admin\PermissionResource;
use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        return ProductsResource::collection(
            Product::when(
                auth()->user()->account_id != 1,
                function ($q) {
                    $q->where('status', 1)->orWhere('account_id', auth()->user()->account_id);
                }
            )->advancedFilter()
            ->paginate(
                request('rowsPerPage', 20)
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        return response([
            'meta' => [
                'category' => Category::when(
                    auth()->user()->account_id != 1,
                    function ($q) {
                        $q->where('status', 1);
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
    public function store(ProductRequest $request)
    {
        $data = [
            'user_id' => auth()->id()
        ];
        auth()->user()->account->products()->create($request->validated() + $data);
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
    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        return response([
            'data' => new PermissionResource($product),
            'meta' => [
                'category' => Category::when(
                    auth()->user()->account_id != 1,
                    function ($q) {
                        $q->where('status', 1);
                    }
                )->get(['id', 'name'])
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return  response(null, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, 'ليس لديك الصلاحية الكافية لتنفيذ هذه العملية');
        if (auth()->user()->account_id != $product->account_id)
            throw new Exception('ليس لك الحق في حذف هذا المنتج');
        elseif ($product->status == 1)
            throw new Exception('هذا المنتج عام لا يمكنك حذفه');
        else
            $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
