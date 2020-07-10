<?php 



namespace App\Repositories\Contracts;




interface UserRepositoryInterface
{
    public function create($data);

    public function update($user,$data);

    public function delete($user);

    public function getAdmins();
}