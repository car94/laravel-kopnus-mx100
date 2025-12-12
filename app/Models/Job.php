<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    protected $fillable = ['employer_id','title','description','status'];

    public function employer() {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications() {
        return $this->hasMany(JobApplication::class);
    }
}
