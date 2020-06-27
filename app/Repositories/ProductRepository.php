<?php


namespace App\Repositories;

use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;


class ProductRepository extends AbstractRepo implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }




    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }


    


    /**
     * Get Queries
     * 
     */

    public function paginatedProducts($num=9)
    {
        return $this->model->with('colors','category')->latest()->paginate($num);
    }
  
}