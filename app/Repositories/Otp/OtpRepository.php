<?php

namespace App\Repositories\Otp;

use LaravelEasyRepository\Repository;

interface OtpRepository extends Repository{

    public function updateOrCreate($user_id, $verify_source, array $data);

    public function deleteCode($user_id, $verify_source);
}
