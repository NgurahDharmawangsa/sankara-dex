<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Http\Requests\SubCategoryRequest;
use App\Services\Category\CategoryService;
use App\Services\SubCategory\SubCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubCategoryController extends Controller
{

    protected $subCategoryService, $categoryService;

    public function __construct(SubCategoryService $subCategoryService, CategoryService $categoryService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        Gate::authorize('isAdmin');
        Breadcrumb::set(['name' => 'Sub Category', 'href' => route('master.subcategory.index')]);
        $data['categories'] = $this->categoryService->all()->getResult();
        return view('apps.subcategory.subcategory', $data);
    }

    public function table(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->subCategoryService->datatable();
        }
        return abort(404);
    }

    public function create(SubCategoryRequest $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            $data = $request->only(['category_id', 'name']);
            return $this->subCategoryService->create($data)->toJson();
        }
        return abort(404);
    }

    public function edit(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->subCategoryService->findOrFail($id)->toJson();
        }
        return abort(404);
    }

    public function update(SubCategoryRequest $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            $data = $request->only(['id', 'category_id','name']);
            return $this->subCategoryService->update($data['id'], $data)->toJson();
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            $data = $request->only('id');
            return $this->subCategoryService->delete($data['id'])->toJson();
        }
        return abort(404);
    }

    public function changeStatus(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->subCategoryService->changeStatus($id)->toJson();
        }
        return abort(404);
    }

    public function all(Request $request)
    {
        if ($request->ajax()) {
            return $this->subCategoryService->all()->toJson();
        }

        abort(404);
    }

    public function getByCategory(Request $request, $categoryId)
    {
        if($request->ajax()) {
            return $this->subCategoryService->getByCategory($categoryId)->toJson();
        }
        return abort(404);
    }
}
