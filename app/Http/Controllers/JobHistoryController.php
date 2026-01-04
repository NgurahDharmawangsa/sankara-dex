<?php

namespace App\Http\Controllers;

use App\Helpers\Breadcrumb;
use App\Services\Job\JobService;
use App\Services\SubCategory\SubCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobHistoryController extends Controller
{
    protected $jobService, $subCategoryService;

    public function __construct(
        JobService $jobService,
        SubCategoryService $subCategoryService
    )
    {
        $this->jobService = $jobService;
        $this->subCategoryService = $subCategoryService;
    }

    public function index()
    {
        Gate::authorize('isStaff');
        Breadcrumb::set(['name' => 'Job History', 'href' => route('history.index')]);

        $data['subCategories'] = $this->subCategoryService->all()->getResult();
        return view('apps.job-history.job-history', $data);
    }

    public function datatable(Request $request)
    {
        Gate::authorize('isStaff');

        if ($request->ajax()) {
            if(@$request->start_date != "") {
                $data['start'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
            }
            if(@$request->end_date != "") {
                $data['end'] = date('Y-m-d', strtotime(str_replace('/', '-',$request->end_date)));
            }
            $data['subcategory_id'] = $request->subcategory_id;
            return $this->jobService->datatableHistory($data);
        }
        return abort(404);
    }

    public function jamKerja(Request $request){
        Gate::authorize('isStaff');

        if($request->ajax()){
            $data = $request->only(['subcategory_id','date_from','date_to']);
            return $this->jobService->totalJamKerja($data)->getResult();
        }
    }
}
