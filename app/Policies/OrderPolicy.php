<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function before(User $user)
    {
        if ( $user->is_admin )
        {
            return true;
        }
    }

    public function update(User $user , Order $order)
    {
       return $user->id === $order->user_id;
    }

}
