<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function register($data);

    public function findByEmail($email);

    public function datatable();

    public function avatar($userId, $data);
}
