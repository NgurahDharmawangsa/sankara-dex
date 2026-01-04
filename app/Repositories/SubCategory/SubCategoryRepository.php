<?php

namespace App\Repositories\SubCategory;

use LaravelEasyRepository\Repository;

interface SubCategoryRepository extends Repository{

    public function datatable();
    public function findByCategoryId($id);

    public function getByCategory($categoryId);
}
