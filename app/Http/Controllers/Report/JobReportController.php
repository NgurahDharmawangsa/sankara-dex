<?php

namespace App\Http\Controllers\Report;

use App\Exports\JobsExport;
use App\Helpers\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Services\Report\ReportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JobReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * view report job
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        if(!auth()->user()->isAdmin()) {
            return abort(403);
        }

        Breadcrumb::set(['name' => 'Report', 'href' => route('report.job.index')]);

        return view('apps.reports.Job.index');
    }

    /**
     * download excel
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        $dataRequest = $request->only(['date_from','date_to']);
        $dataRequest['date_from'] = date('Y-m-d', strtotime($dataRequest['date_from'])).' 00:00:00';
        $dataRequest['date_to'] = date('Y-m-d', strtotime($dataRequest['date_to'])).' 23:59:59';
        $data['jobs'] = $this->reportService->getDataReport($dataRequest);
        $data['from'] = $dataRequest['date_from'];
        $data['to'] = $dataRequest['date_to'];
        return Excel::download(new JobsExport($data), 'jobs-report.xlsx');
    }
}
