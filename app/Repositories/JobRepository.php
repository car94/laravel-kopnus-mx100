<?php
namespace App\Repositories;

use App\Models\Job;

class JobRepository {
    public function create(array $data): Job {
        return Job::create($data);
    }

    public function find($id): ?Job {
        return Job::with('applications.freelancer')->find($id);
    }

    public function getPublished() {
        return Job::where('status','published')->latest()->paginate(10);
    }

    public function update(Job $job, array $data) {
        $job->update($data);
        return $job;
    }
}
