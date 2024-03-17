<?php

namespace App\Providers;

use App\Interfaces\{
    CommentRepositoryInterface,
    EssentialRepositoryInterface,
    PrefixCodeRepositoryInterface,
    RealEstateRepositoryInterface,
    RolRepositoryInterface,
    SpecialityRepositoryInterface,
    StandardRepositoryInterface,
    UserRepositoryInterface,
    UserRolRepositoryInterface
};
use App\Repositories\{
    CommentRepository,
    EssentialRepository,
    PrefixCodeRepository,
    RealEstateRepository,
    RolRepository,
    SpecialityRepository,
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
        $this->app->bind(SpecialityRepositoryInterface::class, SpecialityRepository::class);
        $this->app->bind(RealEstateRepositoryInterface::class, RealEstateRepository::class);
        $this->app->bind(PrefixCodeRepositoryInterface::class, PrefixCodeRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }
}
