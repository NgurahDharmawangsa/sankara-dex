<?php

namespace App\Services\Login;

use App\Jobs\SendMailForgotOtpQueueJob;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\Login\LoginRepository;
use App\Repositories\Otp\OtpRepository;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

/**
 *
 */
class LoginServiceImplement extends ServiceApi implements LoginService
{

  /**
   * set message api for CRUD
   * @param string $title
   * @param string $create_message
   * @param string $update_message
   * @param string $delete_message
   */
  protected $title = "";
  /**
   * @var string
   */
  protected $create_message = "";
  /**
   * @var string
   */
  protected $update_message = "";
  /**
   * @var string
   */
  protected $delete_message = "";

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository, $otpRepository;

  /**
   * @param LoginRepository $mainRepository
   */
  public function __construct(UserRepository $mainRepository, OtpRepository $otpRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->otpRepository = $otpRepository;
  }

  /**
   * @param array $data
   * @return LoginServiceImplement|mixed
   */
  public function login(array $data)
  {
    if (@!$data['remember']) {
      $data['remember'] = false;
    }
    if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'])) {
      if(auth()->user()->isAdmin()){
        $redirect = redirect()->intended(URL::route('dashboard'));
      }else{
        $redirect = redirect()->intended(URL::route('job.index'));
      }
      return $this->setStatus(true)
        ->setCode(200)
        ->setMessage('Login Berhasil')
        ->setResult(['redirect' => $redirect->getTargetUrl(), 'data' => auth()->user()]);
    } else {
      return $this->setStatus(false)
        ->setCode(401)
        ->setMessage('Kredinsial login tidak diterima');
    }
  }

  /**
   * @return LoginServiceImplement
   */
  public function logout()
  {
    auth()->logout();
    return $this->setStatus(true)
      ->setCode(200)
      ->setMessage('Logout berhasil');
  }

  public function forgotPassword($data)
  {
    try {
      $rand = rand(111111, 999999);
      $dataOtp = [
        'user_id' => $data['user_id'],
        'code' => $rand,
        'expired_at' => Carbon::now()->addMinutes(3),
        'verify_source' => $data['email']
      ];
      $this->otpRepository->updateOrCreate($data['user_id'], $data['email'], $dataOtp);

      dispatch(new SendMailForgotOtpQueueJob($data['email'], $rand));

      return $this->setStatus(true)
        ->setCode(200)
        ->setMessage("Verification code has been sent to your email. Please check your email.")
        ->setResult(['redirect' => route('forgot.verification', $data['user_id'])]);
    } catch (\Exception $exception) {
      return $this->exceptionResponse($exception);
    }
  }

  public function validateForgotCode($data)
  {
      DB::beginTransaction();
      try {
          // delete code otp
          $this->otpRepository->deleteCode($data['user_id'], $data['verify_source']);

          DB::commit();
          return $this->setStatus(true)
              ->setCode(200)
              ->setMessage("Code verification match")
              ->setResult(['redirect' => route('reset.password', $data['user_id'])]);
      } catch (\Exception $exception) {
          DB::rollBack();
          return $this->exceptionResponse($exception);
      }
  }

  public function resetPassword($data)
    {
        try {
            $data['password'] = Hash::make($data['new_password']);
            unset($data['new_password']);
            // delete code otp
            $this->mainRepository->update($data['user_id'], $data);

            return $this->setStatus(true)
                ->setCode(200)
                ->setMessage("Password reset successful")
                ->setResult(['redirect' => route('login')]);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
