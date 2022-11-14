<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Admin\PermissionResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return CategoryResource::collection(
            Category::when(
                auth()->user()->account_id != 1,
                function ($q) {
                    $q->where('status', 1);
                }
            )->advancedFilter()->paginate(
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        auth()->user()->account->categories()->create($request->validated());
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
    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new PermissionResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return  response(null, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (auth()->user()->account_id != $category->account_id)
            throw new Exception('ليس لك الحق في حذف هذا القسم');
        elseif ($category->status == 1)
            throw new Exception('هذا القسم عام لا يمكنك حذفه');
        else
            $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
