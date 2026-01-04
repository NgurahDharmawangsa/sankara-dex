<?php

namespace App\Services\Otp;

use LaravelEasyRepository\BaseService;

interface OtpService extends BaseService{

    public function sendOtpEmail($user_id, $email);
}
