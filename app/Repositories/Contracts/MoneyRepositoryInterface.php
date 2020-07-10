<?php 



namespace App\Repositories\Contracts;




interface MoneyRepositoryInterface
{
    public function create($data);

    public function update($object,$data);

    public function delete($object);

    public function getPaginatedRequests($num);
}