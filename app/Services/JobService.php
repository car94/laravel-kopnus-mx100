<?php
namespace App\Services;

use App\Repositories\JobRepository;
use App\Models\Job;

class JobService {
    protected $repo;
    public function __construct(JobRepository $repo) {
        $this->repo = $repo;
    }

    public function createJob(array $data): Job {
        return $this->repo->create($data);
    }

    public function publish(Job $job): Job {
        return $this->repo->update($job, ['status' => 'published']);
    }

    public function getPublishedJobs() {
        return $this->repo->getPublished();
    }

    public function find($id): ?Job {
        return $this->repo->find($id);
    }
}
