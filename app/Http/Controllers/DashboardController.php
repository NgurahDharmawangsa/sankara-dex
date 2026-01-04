<?php

namespace App\Http\Controllers;

// use App\Helpers\Breadcrumb;

use App\Helpers\Breadcrumb;
use App\Models\Role;
use App\Services\Job\JobService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $userService, $jobService;
    public function __construct(UserService $userService, JobService $jobService)
    {
        $this->userService = $userService;
        $this->jobService = $jobService;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Breadcrumb::set(['name' => 'Dashboard', 'href' => route('dashboard')]);
        if (auth()->user()->isStaff()) {
            return redirect()->route('job.index');
        }
        return view('apps.dashboard.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function chart(Request $request)
    {
        if ($request->ajax()) {
            $jobs = $this->jobService->chart()->getResult();

            $endDate = now();
            $startDate = $endDate->copy()->subDays(4);

            $labels = [];
            $data = [];

            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $labels[] = $date->toDateString();
            }

            foreach ($labels as $label) {
                $isFound = [
                    'job' => false,
                ];

                foreach ($jobs as $job) {
                    if($job->date === $label) {
                        $data['chart']['job'][] = @$job->count;
                        $isFound['job'] = true;
                        break;
                    }
                }

                if (!$isFound['job']) {
                    $data['chart']['job'][] = 0;
                }
            }

            return response()->json([
                'data' => $data,
                'labels' => $labels
            ]);
        }
    }
}
