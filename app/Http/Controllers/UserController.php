<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        Gate::authorize('isAdmin');
        Breadcrumb::set(['name' => 'User Management', 'href' => route('user.index')]);
        return view('apps.user.index');
    }

    public function table(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->userService->datatable();
        }
        return abort(404);
    }

    public function create(UserRequest $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            $data = $request->only(['name', 'email', 'password']);
            return $this->userService->create($data)->toJson();
        }
        return abort(404);
    }

    public function edit(Request $request, $id)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->userService->findOrFail($id)->toJson();
        }
        return abort(404);
    }

    public function update(UserRequest $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            $data = $request->only(['id','name','email','password']);
            return $this->userService->update($data['id'], $data)->toJson();
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        Gate::authorize('isAdmin');

        if($request->ajax()) {
            return $this->userService->delete($request->id)->toJson();
        }
        return abort(404);
    }

    public function all(Request $request)
    {
        Gate::authorize('isAdmin');
        if($request->ajax()) {
            return $this->userService->all()->getResult();
        }
        return abort(404);
    }
}
