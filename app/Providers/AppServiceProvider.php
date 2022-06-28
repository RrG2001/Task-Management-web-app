<?php

namespace App\Providers;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\UserRepository;
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

        //Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
