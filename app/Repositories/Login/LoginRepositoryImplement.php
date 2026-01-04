<?php

namespace App\Repositories\Login;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Login;

class LoginRepositoryImplement extends Eloquent implements LoginRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Login $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
