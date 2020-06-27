<?php

namespace App\Http\Controllers;

use App\Province;

class MarkterController extends Controller
{
    public function orders()
    {
        $orders = auth()->user()->orders();

        if ( request()->has('status') and !empty(request('status')) )
        {
            $orders = $orders->where('status',request('status'));
        }

        if ( request()->has('shipping_status') and !empty(request('shipping_status')) )
        {
            $orders = $orders->where('shipping_status',request('shipping_status'));
        }

        $orders = $orders->with('products')->latest()->paginate(10);
        
        return view('dashboard.markters.orders',[
            
            'title'             => trans('software.my_orders'),
            'orders'            => $orders,
            'provinces_choices' => Province::pluck('name','id'),
            
        ]);
    }


    public function wallet()
    {
        


        return view('dashboard.markters.wallet',[

            'title'                      => trans('software.my_wallet'),

            'confirmed'                  => user()->commission, 

            'pending'                    => user()->pending_porfits,

            'unconfirmed_requests_count' => user()->moneyRequests()
                                                   ->where('is_confirmed',0)
                                                   ->where('is_canceld',0)
                                                   ->count(),
                                            
            'requests'                   => user()->moneyRequests()
                                                 ->latest()
                                                 ->paginate(5),                   
        ]);
    }


    public function myCards()
    {
        return view('dashboard.markters.my-cards',[
            'title' => trans('software.my-cards'),
            'cards' => user()->techCards()->latest()->paginate(10),
        ]);
    }


}
