<?php

namespace App\Providers;

use App\Interfaces\Repositories\ProjectRepositoryInterface;
use App\Interfaces\Repositories\Repositories\UserRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Interfaces\Services\ProjectServiceInterface;
use App\Interfaces\Services\TaskServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

/**
 * @method registerPolicies()
 */
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //Services
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);

        //Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }


    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
