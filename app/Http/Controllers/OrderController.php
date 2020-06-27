<?php

namespace App\Http\Controllers;

use Cart;
use App\User;
use App\Order;
use App\Product;
use App\Category;
use App\Province;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Http\Requests\Dashboard\OrderRequest;

class OrderController extends Controller
{

    use OrderTrait;

    public function __construct()
    {
        $this->middleware('admin')->except(['create','edit','store','update','cancelOrder']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(OrdersDataTable $datatable)
    {
        return $datatable->render('dashboard.orders.index', [
            
            'title' => trans('software.orders'),
            'orders' => Order::with('products')->get(),

        ]);
    }


    public function show($id)
    {
        $order = Order::with('products','user','province')->findOrFail($id);
        return view('dashboard.orders.show',compact('order'));
    }

    
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        
        $items           = Cart::session(user()->id)->getContent();

        $total_price     = Cart::session(user()->id)->getTotal();

        $total_commisson = 0;

        $order = user()->orders()->create(

            array_merge($request->all(),['total_price' => $total_price]),

        );

        foreach( $items as $item )
        
        {
            $product = Product::findOrFail($item->id);

            $total_commisson += $item->attributes->commission * $item->quantity ;
        
            $product->update([

                'stock'  => $product->stock - $item->quantity,
                
            ]);

            $order->products()->attach($item->id,[

                'qty' => $item->quantity,

                'price' => $item->price,

                'commission' => $item->attributes->commission,


            ]);
        }

        $order->update([

            'total_commission' => $total_commisson,

        ]);



        Cart::session(user()->id)->clear();

        if ( !auth()->user()->is_admin )
        {
            return redirect()->route('dashboard.products.index');
        }

        return redirect()->route('dashboard.orders.index');
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Order $order)
    {
        abort_if(!$order->is_pending and user()->is_markter,404);
        
        return view('dashboard.orders.edit', [
            'title'     => "تعديل طلب($order->orderId)",
            'order'  => $order,
            'categories' => Category::with('products')->latest()->get(),
            'provinces_choices' => Province::pluck('name','id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        abort_if(!$order->is_pending and user()->is_markter,404);
        
        $this->authorize('update',$order);


        $data = $request->except(['status','shipping_status','shipping_number']);

        $order->update($data);
       

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('dashboard.orders.index');
    }



    



  


    
}
