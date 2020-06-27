<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use App\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $variables = [

            'title'                  => trans('software.home'),
            'orders_count'           => Order::whereDay('created_at',today())->count(),
            'shipped_orders_count'   => Order::shippedOrders()->whereDay('shipped_at',today())->count(),
            'discarded_orders_count' => Order::discardedOrders()->whereDay('discarded_at',today())->count(),
            'canceld_orders_count'   => Order::canceldOrders()->whereDay('canceld_at',today())->count(),
            'total_porfits'          => Order::whereNull('status')->shippedOrders()->whereDay('shipped_at',today())->sum('total_price'),

        ];

        if ( user()->is_markter )
        {
            $variables['orders_count']           = user()->orders()->count();
            $variables['shipped_orders_count']   = user()->orders()->shippedOrders()->count();
            $variables['discarded_orders_count'] = user()->orders()->discardedOrders()->count(); 
            $variables['canceld_orders_count']   = user()->orders()->canceldOrders()->count(); 
            $variables['total_porfits']          = user()->total_porfits;
            $variables['availble_porfits']       = user()->commission;
            $variables['pending_porfits']        = user()->pending_porfits; 

        }

        return view('dashboard.home',$variables);
    }
}



