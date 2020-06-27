<?php 



namespace App\Repositories\Contracts;




interface ProductRepositoryInterface
{
    public function create($data);

    public function update($product,$data);

    public function delete($product);

    public function findById($id);
    
    public function paginatedProducts($num);

}