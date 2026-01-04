<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Login\LoginService;
use App\Services\Otp\OtpService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginService, $userService, $otpService;

    public function __construct(LoginService $loginService, UserService $userService, OtpService $otpService)
    {
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->otpService = $otpService;
    }
    
    public function index()
    {
        return view("apps.auth.login");
    }

    public function login(LoginRequest $request)
    {
        if($request->ajax()) {
            $data = $request->only(['email', 'password', 'remember']);
            return $this->loginService->login($data)->toJson();
        }
        return abort(404);
    }

    public function forgot()
    {
        return view("apps.auth.forgot-password");
    }

    public function sendForgot(Request $request)
    {
        if($request->ajax()) {
            $data = $request->only(['email']);
            $user = $this->userService->findByEmail($data['email']);
            $data['user_id'] = $user->id;

            return $this->loginService->forgotPassword($data)->toJson();
        }
        return abort(404);
    }

    public function verificationForgot($user_id)
    {
        $data['user_id'] = $user_id;
        $data['verify_source'] = $this->userService->findOrFail($user_id)->getResult()->email;
        return view('apps.auth.verification-forgot', $data);
    }

    public function resendEmail(Request $request)
    {
        $data = $request->only(['user_id','email']);
        $this->otpService->sendOtpEmail($data['user_id'], $data['email'], "forgot");
        return redirect()->route('forgot.verification', $data['user_id']);
    }

    public function verificationForgotSubmit(Request $request)
    {
        if($request->ajax()) {
            $data = $request->only(['user_id','code','verify_source']);
            return $this->loginService->validateForgotCode($data)->toJson();
        }
        return abort(404);
    }

    public function resetPassword($user_id)
    {
        $data['user_id'] = $user_id;
        return view('apps.auth.reset-password', $data);
    }

    public function resetPasswordSubmit(Request $request, $user_id)
    {
        if($request->ajax()) {
            $data = $request->only(['new_password']);
            $data['user_id'] = $user_id;
            return $this->loginService->resetPassword($data)->toJson();
        }
        return abort(404);
    }

    public function logout()
    {
        $this->loginService->logout();
        return redirect()->route('login');
    }
}
