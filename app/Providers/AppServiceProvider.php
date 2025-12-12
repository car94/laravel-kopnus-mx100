<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\JobRepository;
use App\Repositories\ApplicationRepository;
use App\Services\JobService;
use App\Services\ApplicationService;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(JobRepository::class);
        $this->app->singleton(ApplicationRepository::class);
        $this->app->singleton(JobService::class, function($app) {
            return new JobService($app->make(JobRepository::class));
        });
        $this->app->singleton(ApplicationService::class, function($app) {
            return new ApplicationService($app->make(ApplicationRepository::class), $app->make(JobRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
