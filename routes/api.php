<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Freelancer\JobController as FreelancerJobController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Employer routes
    Route::prefix('employer')->middleware('role:employer')->group(function () {
        Route::post('/jobs', [EmployerJobController::class, 'store']);
        Route::patch('/jobs/{id}/publish', [EmployerJobController::class, 'publish']);
        Route::get('/jobs/{id}/applications', [EmployerJobController::class, 'applications']);
    });

    // Freelancer routes
    Route::prefix('freelancer')->middleware('role:freelancer')->group(function () {
        Route::get('/jobs', [FreelancerJobController::class, 'index']);
        Route::post('/jobs/{id}/apply', [FreelancerJobController::class, 'apply']);
    });
});
