<?php

namespace App\Http\View\Composers;

use App\Province;
use Illuminate\View\View;
use Cart;
class NavbarComposer
{
    private $notifications_count;

    public function __construct()
    {
        $this->notifications_count = user()->unreadNotifications->count();
    }
    
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $arr = [

            'notifications_count'=> $this->notifications_count,
            'cart_count' =>  Cart::session(user()->id)->getContent()->count(),
            'notifications' => user()->unreadNotifications()
                                             ->latest()
                                             ->get(),
            'provinces_choices' => Province::pluck('name','id'),

        ];
        
        $view->with($arr);

       
    }

    

}