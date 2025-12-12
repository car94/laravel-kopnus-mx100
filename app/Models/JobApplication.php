<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model {
    protected $fillable = ['job_id','freelancer_id','cv_url'];

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function freelancer() {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
