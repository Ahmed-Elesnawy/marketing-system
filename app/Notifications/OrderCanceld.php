<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCanceld extends Notification
{
    use Queueable;

    protected $orderId;
    protected $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order,$name)
    {
        $this->orderId = $order->orderId;
        $this->name    = $name;
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
            'orderId' => $this->orderId,
            'name'    => $this->name,
        ];
    }
}
