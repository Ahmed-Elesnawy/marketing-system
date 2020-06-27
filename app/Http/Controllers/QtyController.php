<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class QtyController extends Controller
{
    public function plus(Order $order,Product $product)
    {
       
       $order->products()->find($product->id)->pivot->update([
           'qty' => $order->products()->find($product->id)->pivot->qty +1,
       ]);


       $order->update([

           'total_price'     => $order->total_price + $order->products()->find($product->id)->pivot->price,
           'total_commission' => $order->total_commission + $order->products()->find($product->id)->pivot->commission
       ]);

       return back();
    }


    public function minus(Order $order,Product $product)
    {

       $order->products()->find($product->id)->pivot->update([
           'qty' => $order->products()->find($product->id)->pivot->qty -1,
       ]);


       $order->update([

           'total_price'     => $order->total_price - $order->products()->find($product->id)->pivot->price,
           'total_commission' => $order->total_commission - $order->products()->find($product->id)->pivot->commission
       ]);

       return back();
    }
}
