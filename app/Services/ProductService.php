<?php


namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }


    public function store($request)
    {
       $product =  $this->productRepo->create($this->data($request));

       return $product;
    }


    public function update($product,$request)
    {
        $this->productRepo->update($product,$this->data($request,$product->image));
    }


    public function destroy($product)
    {
        $this->productRepo->delete($product);
    }

    

   


    protected function data($request,$old_image=null)
    {
        $data = $request->validated();

        if ( $request->hasFile('image') )
        {
            if ( is_null($old_image) )
            {
              $data['image'] = upload('image','products',350,350);
            }

            $data['image'] = upload('image','products',350,350,$old_image);
        }

        return $data;
    }



    /**
     * All Product Model Queries
     * 
     */

    
    public function paginatedProducts($num=9)
    {
        return $this->productRepo->paginatedProducts($num);
    }

    



    
}
