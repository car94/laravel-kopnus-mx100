<?php
namespace App\Repositories;

use App\Models\JobApplication;

class ApplicationRepository {
    public function create(array $data): JobApplication {
        return JobApplication::create($data);
    }

    public function exist($jobId, $freelancerId): bool {
        return JobApplication::where('job_id',$jobId)
                ->where('freelancer_id',$freelancerId)
                ->exists();
    }

    public function listByJob($jobId) {
        return JobApplication::with('freelancer')->where('job_id',$jobId)->get();
    }
}
