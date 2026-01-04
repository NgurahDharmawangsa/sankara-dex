<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Helpers\Helper;
use App\Http\Requests\JobRequest;
use App\Http\Requests\JobListRequest;
use App\Models\Role;
use App\Services\Category\CategoryService;
use App\Services\Job\JobService;
use App\Services\SubCategory\SubCategoryService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    protected $jobService, $userService, $subcategoryService, $categoryService;
    public function __construct(JobService $jobService, UserService $userService, SubCategoryService $subcategoryService, CategoryService $categoryService)
        {
            $this->jobService = $jobService;
            $this->userService = $userService;
            $this->subcategoryService = $subcategoryService;
            $this->categoryService = $categoryService;
        }

    /**
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        if (auth()->user()->can('isStaff')) {
            Breadcrumb::set(['name' => 'Create Job', 'href' => route('job.index')]);
            return view('apps.job.job');
        }

        if (auth()->user()->can('isAdmin')) {
            Breadcrumb::set(['name' => 'Job List', 'href' => route('job.index')]);

            $data['jobs'] = $this->jobService->all()->getResult();
            $users = $this->userService->all()->getResult();
            $data['users'] = $users->filter(function ($user) {
                return $user->name !== 'Admin';
            });

            $data['subcategories'] = $this->subcategoryService->all()->getResult();
            $data['categories'] = $this->categoryService->all()->getResult();

            // dd($data);
            return view('apps.job.index', $data);
        }
    }

    public function create(JobListRequest $request)
    {
        if($request->ajax()) {
            $data = $request->only(['user_id', 'subcategory_id', 'title', 'duration']);

            if ($request->date && auth()->user()->isAdmin()) {
                $data['created_at'] = date('Y-m-d', strtotime($request->date)).' '.date('H:i:s');
                $data['updated_at'] = date('Y-m-d', strtotime($request->date)).' '.date('H:i:s');
            }

            return $this->jobService->saveJob($data)->toJson();
        }
    }

    /**
     * datatable
     * @param Request $request
     * @return never
     */
    public function table(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            $data = $request->only(['date_from','date_to','user_id','category','subcategory']);
            return $this->jobService->datatable($data);
        }
        return abort(404);
    }

    /**
     * update data
     * @param Request $request
     * @return never
     */
    public function update(JobListRequest $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            $data = $request->only(['id','user_id','subcategory_id','title','description','duration']);

            if ($request->date && auth()->user()->isAdmin()) {
                $data['created_at'] = date('Y-m-d', strtotime($request->date)).' '.date('H:i:s');
                $data['updated_at'] = date('Y-m-d', strtotime($request->date)).' '.date('H:i:s');
            }

            return $this->jobService->update($data['id'], $data)->toJson();
        }
        return abort(404);
    }

    /**
     * edit data
     * @param Request $request
     * @param $id
     * @return never
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->jobService->findOrFail($id)->toJson();
        }
        return abort(404);
    }

    /**
     * delete data
     * @param Request $request
     * @return never
     */
    public function delete(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->jobService->delete($request->id)->toJson();
        }
        return abort(404);
    }

    public function all(Request $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            return $this->jobService->all()->getResult();
        }
        return abort(404);
    }

    public function workingHours(Request $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            return $this->jobService->findWorkingHours()->getResult();
        }
        return abort(404);
    }
}
