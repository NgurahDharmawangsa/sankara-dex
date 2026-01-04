<?php

namespace App\Repositories\SubCategory;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Subcategory;

class SubCategoryRepositoryImplement extends Eloquent implements SubCategoryRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Subcategory $model)
    {
        $this->model = $model;
    }

    public function datatable()
    {
        return $this->model->with(['category'])->orderBy('updated_at','desc');
    }

    public function all()
    {
        return $this->model->with(['category' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();
    }

    public function findByCategoryId($id)
    {
        return $this->model->where('category_id', $id)->get();
    }

    public function getByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }
}
