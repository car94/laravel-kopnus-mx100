<?php
namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobService;
use App\Services\ApplicationService;

class JobController extends Controller {
    protected $jobService;
    protected $applicationService;

    public function __construct(JobService $jobService, ApplicationService $applicationService) {
        $this->jobService = $jobService;
        $this->applicationService = $applicationService;
    }

    public function index() {
        $jobs = $this->jobService->getPublishedJobs();
        return response()->json($jobs);
    }

    public function apply($id, Request $req) {
        $req->validate(['cv' => 'required|file|mimes:pdf,doc,docx|max:5120']);
        try {
            $application = $this->applicationService->apply($id, $req->user()->id, $req->file('cv'));
            return response()->json($application,201);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 400);
        }
    }
}
