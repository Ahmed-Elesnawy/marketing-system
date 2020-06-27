<?php

namespace App\Notifications;

use App\MoneyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMoneyRequestCreated extends Notification
{
    use Queueable;

    protected $markter_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MoneyRequest $moneyRequest)
    {
        $this->markter_name = $moneyRequest->user->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->markter_name,
        ];
    }
}
