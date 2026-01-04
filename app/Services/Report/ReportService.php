<?php

namespace App\Services\Report;

use LaravelEasyRepository\BaseService;

interface ReportService extends BaseService{

    /**
     * @param $data
     * @return mixed
     */
    public function getDataReport($data);
}
