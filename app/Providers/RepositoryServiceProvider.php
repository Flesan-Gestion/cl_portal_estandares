<?php

namespace App\Providers;

use App\Interfaces\{
    EssentialRepositoryInterface
};
use App\Repositories\{
    EssentialRepository
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
    }
}
