<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('apps.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        if ($request->ajax()) {
            $data = $request->only(['name', 'email', 'password']);
            return $this->userService->register($data)->toJson();
        }
        return abort(404);
    }
}
