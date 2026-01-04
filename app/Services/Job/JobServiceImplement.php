<?php

namespace App\Services\Job;

use App\Models\Job;
use App\Helpers\Helper;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\Job\JobRepository;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class JobServiceImplement extends ServiceApi implements JobService
{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Job";
    protected $create_message = "successful created";
    protected $update_message = "successful updated";
    protected $delete_message = "successful deleted";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(JobRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getByUserId($userId)
    {
        try {
            $result = $this->mainRepository->getByUserId($userId);

            return $this->setCode(200)
                ->setStatus(true)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function saveJob($data)
    {
        try {
            if(auth()->user()->isStaff()) {
                for ($i = 0; $i < count($data['title']); $i++) {
                    $job = [
                        'user_id' => $data['user_id'],
                        'subcategory_id' => $data['subcategory_id'][$i],
                        'title' => $data['title'][$i],
                        'duration' => $data['duration'][$i],
                    ];

                    $this->mainRepository->create($job);
                }
            }

            if(auth()->user()->isAdmin()){
                $job = [
                    'user_id' => $data['user_id'],
                    'subcategory_id' => $data['subcategory_id'],
                    'title' => $data['title'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'duration' => $data['duration'],
                ];

                $this->mainRepository->create($job);
            }

            return $this->setStatus(true)
                ->setCode(200)
                ->setMessage("Successful saved");
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function datatable($data)
    {
        $data['date_from'] = date('Y-m-d', strtotime($data['date_from'])).' 00:00:00';
        $data['date_to'] = date('Y-m-d', strtotime($data['date_to'])).' 23:59:59';
        return DataTables::of($this->mainRepository->datatable($data)->reorder())
            ->addIndexColumn()
            ->addColumn('employee', function ($data) {
                if ($data->user->avatar != null) {
                    $avatar = route('secure.image', \App\Helpers\Helper::encrypt($data->user->avatar));
                } else {
                    $avatar = asset('assets/images/profile/profile.png');
                }
                $html = '<div class="d-flex align-items-center gap-2">
                            <div class="employee-image">
                                <img src="'. $avatar .'" alt="">
                              </div>
                              <p>'. $data->user->name .'</p>
                         </div>';
                return $html;
            })
            ->addColumn('subcat', function ($data) {
                return '<div class="badge bg-primary">'. $data->subcategory->category->name .'</div> | <br> <div class="badge bg-primary-900">'. $data->subcategory->name .'</div>';
            })
            ->editColumn('duration', function ($data) {
                return '<div class="badge bg-primary">'. Helper::convertMinutesToHoursMinutes($data->duration) .' </div>';
            })
            ->addColumn('opsi', function ($data) {
                $html = '
                    <div class="dropdown">
                      <button class="btn btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-cog"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item edit" href="javascript:void(0)" data-id="' . $data->id . '"><i class="bx bx-pencil"></i> Edit</a>
                        <a class="dropdown-item text-danger delete" href="javascript:void(0)" data-id="' . $data->id . '"><i class="bx bx-trash"></i> Delete</a>
                      </ul>
                    </div>';
                return $html;
            })
            ->rawColumns(['opsi','employee','subcat','duration'])
            ->make(true);
    }

    public function datatableHistory($data)
    {
        $data['date_from'] = date('Y-m-d', strtotime($data['start'])).' 00:00:00';
        $data['date_to'] = date('Y-m-d', strtotime($data['end'])).' 23:59:59';

        unset($data['start']);
        unset($data['end']);
        return DataTables::of($this->mainRepository->datatable($data))
            ->addIndexColumn()
            ->addColumn('subcategory', function ($data){
                return $data->subcategory->category->name.' - '.$data->subcategory->name;
            })
            ->make(true);
    }

    public function chart()
    {
        try {
            $results = $this->mainRepository->getChart();

            return $this->setCode(200)
                ->setStatus(true)
                ->setResult($results);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function findWorkingHours()
    {
        try {
            $results = $this->mainRepository->getWorkingHours();

            return $this->setCode(200)
                ->setStatus(true)
                ->setResult($results);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function totalJamKerja($data)
    {
        try {
            $results = $this->mainRepository->totalJamKerja($data);

            return $this->setCode(200)
                ->setStatus(true)
                ->setResult($results);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
