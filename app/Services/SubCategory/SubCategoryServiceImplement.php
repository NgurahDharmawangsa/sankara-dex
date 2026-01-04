<?php

namespace App\Services\SubCategory;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\SubCategory\SubCategoryRepository;
use Yajra\DataTables\DataTables;

class SubCategoryServiceImplement extends ServiceApi implements SubCategoryService
{

  /**
   * set message api for CRUD
   * @param string $title
   * @param string $create_message
   * @param string $update_message
   * @param string $delete_message
   */
  protected $title = "Sub Category";
  protected $create_message = "successful created";
  protected $update_message = "successful updated";
  protected $delete_message = "successful deleted";

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(SubCategoryRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function datatable()
  {
    return DataTables::of($this->mainRepository->datatable()->reorder())
      ->addIndexColumn()
      ->editColumn('is_active', function ($data) {
        return '
                    <div class="form-check form-switch">
                      <input class="form-check-input change-status" type="checkbox" data-id="' . $data->id . '" role="switch" id="isActiveDefault" ' . ($data->is_active == 1 ? 'checked' : '') . '>
                      <label class="form-check-label" for="isActiveDefault"></label>
                    </div>';
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
      ->rawColumns(['opsi', 'is_active', 'category'])
      ->make(true);
  }

  public function changeStatus($id)
  {
    try {
      $category = $this->mainRepository->findOrFail($id);
      $this->mainRepository->update($id, [
        'id' => $id,
        'is_active' => $category->is_active == 1 ? 0 : 1
      ]);

      return $this->setStatus(true)
        ->setCode(200)
        ->setMessage("Successful changed status");
    } catch (\Exception $exception) {
      return $this->exceptionResponse($exception);
    }
  }

  public function all()
  {
      try {
          $results = $this->mainRepository->all();

          return $this->setCode(200)
              ->setStatus(true)
              ->setResult($results);
      } catch (\Exception $exception) {
          return $this->exceptionResponse($exception);
      }
  }

  public function getByCategory($categoryId)
    {
        try {
            $results = $this->mainRepository->getByCategory($categoryId);

            return $this->setStatus(true)
                ->setCode(200)
                ->setResult($results);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
