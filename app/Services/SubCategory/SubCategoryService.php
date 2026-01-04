<?php

namespace App\Services\SubCategory;

use LaravelEasyRepository\BaseService;

interface SubCategoryService extends BaseService{

    public function datatable();

    public function changeStatus($id);

    public function getByCategory($categoryId);
}
