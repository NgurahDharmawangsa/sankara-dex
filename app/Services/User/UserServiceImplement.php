<?php

namespace App\Services\User;

use App\Helpers\StoreFile;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;
use Yajra\DataTables\DataTables;

class UserServiceImplement extends ServiceApi implements UserService{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
     protected $title = "User";
     protected $create_message = "successfully created";
     protected $update_message = "successfully updated";
     protected $delete_message = "successfully deleted";

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function register($data)
    {
      try {
        $user = $this->mainRepository->create($data);
        $user->roles()->attach(Role::STAFF);

        return $this->Setcode(200)
              ->setStatus(true)
              ->setStatus("Successfully Registered")
              ->setResult(['redirect' => route('login')]);
      } catch (\Exception $exception) {
        return $this->exceptionResponse($exception);
      }
    }

    public function findByEmail($email)
    {
        return $this->mainRepository->findByEmail($email);
    }

    public function datatable()
    {
        return DataTables::of($this->mainRepository->datatable()->reorder())
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                if ($data->avatar != null) {
                    $avatar = route('secure.image', \App\Helpers\Helper::encrypt($data->avatar));
                } else {
                    $avatar = asset('assets/images/profile/profile.png');
                }

                $html = '<div class="d-flex align-items-center gap-2">
                            <div class="employee-image">
                                <img src="'. $avatar .'" alt="">
                              </div>
                              <p>'. $data->name .'</p>
                         </div>';
                return $html;
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
            ->rawColumns(['opsi', 'name'])
            ->make(true);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $data['verified_email'] = now();
            $user = $this->mainRepository->create($data);
            $user->roles()->attach(Role::STAFF);

            DB::commit();
            return $this->Setcode(200)
                ->setStatus(true)
                ->setStatus("Successfully create new user");

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->exceptionResponse($exception);
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
            if($data['password'] != "") {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $this->mainRepository->update($id, $data);

            DB::commit();
            return $this->setStatus(true)
                ->setCode(200)
                ->setMessage("Successfully update user");
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->exceptionResponse($exception);
        }
    }

    public function avatar($userId, $data)
    {
        try {
            $user = $this->mainRepository->findOrFail($userId);
            $file = $data['image'];
            $oldFile = storage_path('app/'.$data['old_image']);
            if($file != "") {
                if (file_exists($oldFile)) {;
                    unlink($oldFile);
                }
                $filename = StoreFile::toPrivate($file, "profile");
            } else {
                $filename = @$data['old_image'];
            }
            $user->avatar = $filename;
            $user->save();

            return $this->setStatus(true)
                ->setCode(200)
                ->setMessage("Successfull");
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
