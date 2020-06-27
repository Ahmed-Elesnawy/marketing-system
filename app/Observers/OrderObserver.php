<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Str;
use App\Notifications\NewOrderCreated;
use App\Notifications\OrderProccessing;
use App\Notifications\OrderShipped;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    public function created($order)
    {
        $admins = User::admins()->get();

        Notification::send($admins,new NewOrderCreated($order));
    }
    public function creating($order)
    {
        $order->orderId = '#'.str_pad($order->id+1, 5, Str::random(5), STR_PAD_LEFT);
    }

    public function updating($order)
    {
        
        if ( $order->is_shipped )
        {
            $order->user()->update([
                'commission' => $order->user->commission + $order->total_commission, 
            ]);

            $order->shipped_at = now();
        }

        if ( $order->is_discarded )
        {
            if ($order->user->has_money_request) 
            {
                $order->user
                  ->moneyRequests()
                  ->where('is_confirmed', 0)
                  ->where('is_canceld', 0)
                  ->first()
                  ->update([
                      'is_canceld' => 1,
                      'canceld_at' => now(),
                  ]);
            }
            
            $order->user()->update([

                'commission' => $order->user->commission - $order->total_commission,
                
            ]);

            foreach( $order->products as $product )
            {
                $product->update([
                    
                    'stock' => $product->stock + $product->pivot->qty
                ]);
            }

            
        }

        
    }


    public function updated($order)
    {
        if ( $order->is_shipped and $order->is_alive )
        {
            $order->user->notify(new OrderShipped($order));
        }

        if ( $order->is_processing )
        {
            $order->user->notify(new OrderProccessing($order));
        }

        if ( $order->total_price == 0 )
        {
            $order->delete();
        }

    }


}
