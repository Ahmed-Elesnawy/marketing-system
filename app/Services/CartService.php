<?php 


namespace App\Services;

use Cart;
use App\Repositories\Contracts\ProductRepositoryInterface;

class CartService 
{

    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function addToCart($request,$product)
    {

       $this->validateData($request,$product);

       $commission =  $this->calcCommission($request,$product);



       $this->add($request,$commission,$product);



    }


    public function updateItem($id,$request)
    {

        $product = $this->productRepo->findById($id);

        $this->validateData($request,$product);

        $commission =  $this->calcCommission($request,$product);

        Cart::session(user()->id)->remove($id);
        
        $this->add($request,$commission,$product);



    }




    protected function validateData($request,$product)
    {
        $min_price =  $product->price - $product->commission / 2;

        $request->validate([
            'qty'   => "numeric|min:1|max:{$product->stock}",
            'price' => "numeric|min:{$min_price}",
        ]);
    }


    protected function calcCommission($request,$product)
    {
        $commission = 0;

        if ( $request->price > $product->price ){

            $commission = $product->commission +  ( $request->price - $product->price );


        } elseif ( $request->price < $product->price ){

            $commission = $product->commission -  ( $product->price - $request->price );

        } else {

            $commission = $product->commission;
        }

        return $commission;
    }


    protected function add($request,$commission,$product)
    {
        Cart::session(user()->id)->add([

            'id' => $product->id,
            'name' => $product->name,
            'price' => $request->price,
            'quantity' => $request->qty,
            'attributes' => [
                'commission' =>  $commission,
            ],
    
         ]);    
    }
}