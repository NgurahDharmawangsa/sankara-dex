<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        Breadcrumb::set(['name' => 'Profile', 'href' => route('profile.index')]);

        $data['result'] = $this->userService->findOrFail(auth()->user()->id)->getResult();
        return view('apps.user.profile', $data);
    }

    public function update(ProfileRequest $request)
    {
        if($request->id != auth()->user()->id) {
            return abort(404);
        }

        if($request->ajax()) {
            $data = $request->only(['id','name' ,'email', 'new_password','confirm_password']);
            if($data['new_password'] != "") {
                $data['password'] = $data['new_password'];
            } else {
                $data['password'] = null;
            }
            return $this->userService->update($data['id'], $data)->toJson();
        }
        return abort(404);
    }

    public function avatar(AvatarRequest $request)
    {
        if ($request->ajax()) {
            $data = $request->only(['image', 'old_image']);
            return $this->userService->avatar(auth()->user()->id, $data)->toJson();
        }
        abort(404);
    }
}
