<?php
namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Repositories\JobRepository;
use App\Models\JobApplication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ApplicationService {
    protected $repo;
    protected $jobRepo;
    public function __construct(ApplicationRepository $repo, JobRepository $jobRepo) {
        $this->repo = $repo;
        $this->jobRepo = $jobRepo;
    }

    public function apply(int $jobId, int $freelancerId, UploadedFile $cv): JobApplication {
        if ($this->repo->exist($jobId, $freelancerId)) {
            throw new \Exception('Already applied');
        }

        $job = $this->jobRepo->find($jobId);
        if (!$job || $job->status !== 'published') {
            throw new \Exception('Cannot apply to this job');
        }

        $path = $cv->store('cvs');

        return $this->repo->create([
            'job_id' => $jobId,
            'freelancer_id' => $freelancerId,
            'cv_url' => $path,
        ]);
    }

    public function listByJob($jobId) {
        return $this->repo->listByJob($jobId);
    }
}
