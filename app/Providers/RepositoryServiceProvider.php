<?php

namespace App\Providers;

use App\Interfaces\{
    EssentialRepositoryInterface,
    RolRepositoryInterface,
    StandardRepositoryInterface,
    UserRepositoryInterface,
    UserRolRepositoryInterface
};
use App\Repositories\{
    EssentialRepository,
    RolRepository,
    StandardRepository,
    UserRepository,
    UserRolRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EssentialRepositoryInterface::class, EssentialRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RolRepositoryInterface::class, RolRepository::class);
        $this->app->bind(UserRolRepositoryInterface::class, UserRolRepository::class);
        $this->app->bind(StandardRepositoryInterface::class, StandardRepository::class);
    }
}
