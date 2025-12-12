<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobService;
use App\Services\ApplicationService;
use App\Repositories\JobRepository;
use App\Models\Job;

class JobController extends Controller {
    protected $jobService;
    protected $applicationService;

    public function __construct(JobService $jobService, ApplicationService $applicationService) {
        $this->jobService = $jobService;
        $this->applicationService = $applicationService;
    }

    public function store(Request $req) {
        $data = $req->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:draft,published'
        ]);

        $data['employer_id'] = $req->user()->id;
        $job = $this->jobService->createJob($data);
        return response()->json($job,201);
    }

    public function publish($id, Request $req) {
        $job = $this->jobService->find($id);
        if (!$job || $job->employer_id !== $req->user()->id) {
            return response()->json(['message'=>'Not found or unauthorized'],404);
        }
        $job = $this->jobService->publish($job);
        return response()->json($job);
    }

    public function applications($id, Request $req) {
        $job = $this->jobService->find($id);
        if (!$job || $job->employer_id !== $req->user()->id) {
            return response()->json(['message'=>'Not found or unauthorized'],404);
        }
        $apps = $this->applicationService->listByJob($id);
        return response()->json($apps);
    }
}
