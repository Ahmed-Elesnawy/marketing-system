<?php

namespace App\Observers;

use App\User;
use App\Notifications\NewUserCreated;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    protected $admins;

    public function __construct()
    {
        $this->admins = User::admins()->get();
    }
    
    public function created($user)
    {
       
        
        Notification::send($this->admins,new NewUserCreated($user));
        
        
    }
    public function deleted($user)
    {
        check_file($user->image);
    }
}
