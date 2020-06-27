<?php


namespace App\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderCanceld;
use Illuminate\Support\Facades\Gate;
use App\Notifications\OrderDiscarded;
use Illuminate\Support\Facades\Notification;

trait OrderTrait 
{
    public function changeStatus(Order $order,Request $request)
    {

        $this->authorize('update',$order);

        if ($request->ajax()) 
        {
            $data = $request->validate([

            'shipping_status' => ['required','in:shipped,processing,pending'],
            'shipping_number' => ['nullable','numeric'],

           ]);

            $order->update($data);
        }

        return response()->json(['status' => $order->shipping_status]);
    }


    public function cancelOrder(Order $order)
    {
        if ( Gate::denies('cancel-order',$order) )
        {
            abort(404);
        }

        $this->authorize('update',$order);

        $order->update([

            'status'     => 'canceld',
            'canceld_at' => now(),

        ]);


        if ( user()->is_markter )
        {
            Notification::send(User::admins()->get(),new OrderCanceld($order,user()->name));
        }



        if ( user()->is_admin )
        {
            Notification::send($order->user,new OrderCanceld($order,user()->name));
        }
        

        return back();

    }


    public function discardOrder(Order $order)
    {
        $order->update([

            'status'       => 'discarded',
            'discarded_at' => now(),
        ]);
        
        Notification::send($order->user,new OrderDiscarded($order));

        return back();
    }




    public function removeProduct(Order $order ,$productId)
    {
        $qty        = $order->products()->find($productId)->pivot->qty;
        $commission = $order->products()->find($productId)->pivot->commission;
        $price      = $order->products()->find($productId)->pivot->price;

        $order->products()->detach($productId);

        $order->update([

            'total_commission' => $order->total_commission - $commission * $qty, 
            'total_price'      => $order->total_price      - $price * $qty,
        ]);

        return back();
    }
}