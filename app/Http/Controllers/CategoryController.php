<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Http\Requests\CategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        Gate::authorize('isAdmin');
        Breadcrumb::set(['name' => 'Category', 'href' => route('master.category.index')]);
        return view('apps.category.category');
    }

    public function table(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->categoryService->datatable();
        }
        return abort(404);
    }

    public function create(CategoryRequest $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            $data = $request->only(['name']);
            return $this->categoryService->create($data)->toJson();

        }
        return abort(404);
    }

    public function edit(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->categoryService->findOrFail($id)->toJson();
        }
        return abort(404);
    }

    public function update(CategoryRequest $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            $data = $request->only(['id','name']);            
            return $this->categoryService->update($data['id'], $data)->toJson();
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->categoryService->delete($request->id)->toJson();
        }
        return abort(404);
    }

    public function changeStatus(Request $request, $id)
    {
        if($request->ajax()) {
            return $this->categoryService->changeStatus($id)->toJson();
        }
        return abort(404);
    }
}
