<?php

namespace App\Repositories\Job;

use LaravelEasyRepository\Repository;

interface JobRepository extends Repository{

    public function getByUserId($userId);

    public function all();

    /**
     * datatable with parameter
     * @param $data
     * @return mixed
     */
    public function datatable($data);

    public function getChart();

    public function getWorkingHours();

    public function totalJamKerja($data);
}
