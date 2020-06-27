<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Province;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    
    public function cart()
    {
        
        return view('dashboard.markters.cart',[
            'title' => trans('software.cart'),
            'provinces_choices' => Province::pluck('name','id'),
        ]);

    }



    public function addToCart(Request $request,Product $product)
    
    {
        
        $this->cartService->addToCart($request,$product);

        alert()->success(trans('software.success'),trans('software.product_to_cart'));

        return back();
    }


    public function updateItem($id,Request $request)
    {
        

        $this->cartService->updateItem($id,$request);

        alert()->success(trans('software.success'),trans('software.success_updated'));


        return back();
    }


    public function clearItem($id)
    {
        Cart::session(user()->id)->remove($id);

        alert()->success(trans('software.success'),trans('software.product_from_cart'));

        return back();
    }

    public function clearCart()
    {
        Cart::session(user()->id)->clear();
        
        alert()->success(trans('software.success'),trans('software.cart_cleared'));

        return back();
    }
}
