<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

         'App\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('cancel-order',function($user,$order){

            if ( $user->is_admin and !$order->is_shipped )
            {
                return true;
            }

            if ( $user->is_markter and $order->is_pending )
            {
                return true;
            }

            return false;
        });


        Gate::define('delete-message',function($user){

            return $user->is_admin;
        });
    }
}
