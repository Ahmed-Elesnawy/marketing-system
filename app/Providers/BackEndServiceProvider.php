<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackEndServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface',
        'App\Repositories\UserRepository'
        );

        $this->app->bind('App\Repositories\Contracts\CategoryRepositoryInterface',
        'App\Repositories\CategoryRepository'
        );

        $this->app->bind('App\Repositories\Contracts\ColorRepositoryInterface',
        'App\Repositories\ColorRepository'
        );

        $this->app->bind('App\Repositories\Contracts\ProvinceRepositoryInterface',
        'App\Repositories\ProvinceRepository'
        );

        $this->app->bind('App\Repositories\Contracts\ProductRepositoryInterface',
        'App\Repositories\ProductRepository'
        );

        $this->app->bind('App\Repositories\Contracts\MoneyRepositoryInterface',
        'App\Repositories\MoneyRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
