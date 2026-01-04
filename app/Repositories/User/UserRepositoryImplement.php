<?php

namespace App\Repositories\User;

use App\Models\Role;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function datatable()
    {
        return $this->model->whereHas('roles', function($q) {
            $q->where('roles.id', '!=', Role::ADMIN);
        })->with(['roles'])->orderBy('updated_at', 'desc');
    }
}
