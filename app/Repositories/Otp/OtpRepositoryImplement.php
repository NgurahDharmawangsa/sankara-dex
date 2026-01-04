<?php

namespace App\Repositories\Otp;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Otp;

class OtpRepositoryImplement extends Eloquent implements OtpRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Otp $model)
    {
        $this->model = $model;
    }

    public function updateOrCreate($user_id, $verify_source, array $data)
    {
        return $this->model->updateOrCreate(['user_id' => $user_id, 'verify_source' => $verify_source], $data);
    }

    public function deleteCode($user_id, $verify_source)
    {
        return $this->model->where('user_id', $user_id)->where('verify_source', $verify_source)->delete();
    }
}
