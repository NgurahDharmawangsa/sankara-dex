<?php

namespace App\Services\Job;

use LaravelEasyRepository\BaseService;

interface JobService extends BaseService{

    public function getByUserId($userId);

    public function saveJob($data);

    public function datatable($data);

    public function datatableHistory($data);

    public function chart();

    public function findWorkingHours();

    public function totalJamKerja($data);
}
