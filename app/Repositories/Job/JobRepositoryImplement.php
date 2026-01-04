<?php

namespace App\Repositories\Job;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Job;

class JobRepositoryImplement extends Eloquent implements JobRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Job $model)
    {
        $this->model = $model;
    }

    public function getByUserId($userId)
    {
        return $this->model->with('user')->where('user_id', $userId)->first();
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatable($data)
    {
        return $this->model->with(['subcategory','user'])
            ->when(@auth()->user()->id != "", function ($query) use ($data) {
                if(auth()->user()->can('isStaff')){
                    $query->where('user_id', auth()->user()->id);
                }
            })
            ->when(@$data['subcategory_id'] != '', function ($query) use ($data) {
                $query->where('subcategory_id', $data['subcategory_id']);
            })
            ->when(@$data['date_from'] && @$data['date_to'], function($query) use ($data) {
                $query->whereBetween('jobs.created_at', [$data['date_from'], $data['date_to']]);
            })
            ->when(@$data['user_id'] != "", function($query) use ($data) {
                $query->where('jobs.user_id', '=', @$data['user_id']);
            })
            ->when(@$data['category'] != "", function($query) use ($data) {
                $query->whereHas('subcategory', function ($q) use ($data) {
                    $q->where('category_id', '=', @$data['category']);
                });
            })
            ->when(@$data['subcategory'] != "", function($query) use ($data) {
                $query->where('subcategory_id', '=', @$data['subcategory']);
            })
            ->orderBy('jobs.updated_at', 'desc');
    }

    public function getChart()
    {
        $start = date('Y-m-d', strtotime('-5 days')).' 00:00:01';
        $end = date('Y-m-d').' 23:59:59';
        return DB::table('jobs')->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
        ->whereBetween('created_at', [$start, $end])
        ->orderBy('date', 'asc')
        ->groupBy('date')
        ->get();
    }

    public function getWorkingHours()
    {
        return $this->model->sum('duration');
    }

    public function totalJamKerja($data)
    {
        $userId= auth()->user()->id;
        $start = date("Y-m-d", strtotime($data['date_from'])).' 00:00:01';
        $end = date("Y-m-d", strtotime($data['date_to'])).' 23:59:59';
        return $this->model->where('user_id',$userId)->whereBetween('created_at', [$start, $end])
        ->when(@$data['subcategory_id'] != "", function($query) use ($data) {
            $query->where('subcategory_id', '=', @$data['subcategory_id']);
        })
        ->sum('duration');
    }
}
