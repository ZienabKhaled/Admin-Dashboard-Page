<?php

namespace App\Providers;

use App\Repositories\ControllerRepository;
use App\Repositories\ControllerInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(ControllerInterface::class, ControllerRepository::class);
    }
}
