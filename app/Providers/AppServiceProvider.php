<?php

namespace App\Providers;

use App\User;
use App\Order;
use App\Message;
use App\Product;
use App\Category;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\MessageObserver;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Providers\BackEndServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [

        ServerProvider::class => BackEndServiceProvider::class,

    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        Message::observe(MessageObserver::class);


    }
}
