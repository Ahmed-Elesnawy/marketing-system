<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.index',[

            'title' => trans('software.reports'),

            'reports' => Report::latest()->paginate(10),

            'users_choices' => User::markters()->pluck('name','id'),
        ]);

    }


    public function store(Request $request)
    {
        $between = [date($request->from),date($request->to)];

        $data = $request->validate([

            'from' => 'required|date',

            'to'   => 'required|date',

            'user_id' => 'nullable|numeric',
            

        ]);

        if ( is_null($data['user_id']) )
        {
            $data['total_orders']     = Order::whereBetween('created_at',$between)->count();
            $data['shipped_orders']   = Order::shippedOrders()->whereBetween('shipped_at',$between)->count();
            $data['canceld_orders']   = Order::canceldOrders()->whereBetween('canceld_at',$between)->count();
            $data['discarded_orders'] = Order::discardedOrders()->whereBetween('discarded_at',$between)->count();
            $data['total_porfits']    = Order::whereNull('status')->shippedOrders()->whereBetween('created_at',$between)->sum('total_price');

        } else {

            $user = User::findOrFail($data['user_id']);

            $data['total_orders']     = $user->orders()->whereBetween('created_at',$between)->count();
            $data['shipped_orders']   = $user->orders()->shippedOrders()->whereBetween('shipped_at',$between)->count();
            $data['canceld_orders']   = $user->orders()->canceldOrders()->whereBetween('canceld_at',$between)->count();
            $data['discarded_orders'] = $user->orders()->discardedOrders()->whereBetween('discarded_at',$between)->count();
            $data['total_porfits']    = $user->orders()->shippedOrders()->whereBetween('created_at',$between)->sum('total_commission');
            $data['shipped_to_total'] = $data['total_orders'] != 0 ? $data['shipped_orders']/$data['total_orders']*100 : 0;
        }

        Report::create($data);

        return back();
        
    }


    public function destroy(Report $report)
    {
        $report->delete();
        return back();
    }
}
