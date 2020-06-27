<?php 



namespace App\Repositories\Contracts;




interface ColorRepositoryInterface
{
    public function create($data);

    public function update($category,$data);

    public function delete($category);
}