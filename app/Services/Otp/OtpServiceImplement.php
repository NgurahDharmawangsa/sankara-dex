<?php

namespace App\Services\Otp;

use App\Jobs\SendMailForgotOtpQueueJob;
use App\Jobs\SendMailOtpQueueJob;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\Otp\OtpRepository;
use Carbon\Carbon;

class OtpServiceImplement extends ServiceApi implements OtpService
{

  /**
   * set message api for CRUD
   * @param string $title
   * @param string $create_message
   * @param string $update_message
   * @param string $delete_message
   */
  protected $title = "";
  protected $create_message = "";
  protected $update_message = "";
  protected $delete_message = "";

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(OtpRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function sendOtpEmail($user_id, $email, $type = "verify")
  {
    try {
      $rand = rand(111111, 999999);
      $data = [
        'user_id' => $user_id,
        'code' => $rand,
        'expired_at' => Carbon::now()->addMinutes(3),
        'verify_source' => $email
      ];

      $this->mainRepository->updateOrCreate($user_id, $email, $data);

      if ($type == "verify") {
        dispatch(new SendMailOtpQueueJob($email, $rand));
      } else if ($type == "forgot") {
        dispatch(new SendMailForgotOtpQueueJob($email, $rand));
      }

      $this->mainRepository->updateOrCreate($user_id, $email, $data);
    } catch (\Exception $exception) {
      return $this->exceptionResponse($exception);
    }
  }
}
