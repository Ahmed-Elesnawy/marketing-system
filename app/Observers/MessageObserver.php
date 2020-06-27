<?php

namespace App\Observers;

use App\User;
use App\Notifications\NewMessageCreated;
use Illuminate\Support\Facades\Notification;

class MessageObserver
{
    public function created($message)
    {
        Notification::send(User::markters()->get(),new NewMessageCreated($message->title));
    }
}
