<?php

namespace App\Services\Report;

use App\Repositories\Job\JobRepository;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\Report\ReportRepository;

class ReportServiceImplement extends ServiceApi implements ReportService{

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

    public function __construct(JobRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getDataReport($data)
    {
        return $this->mainRepository->datatable($data)->get();
    }
}
