<?php


namespace App\Repositories;

use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;


class UserRepository extends AbstractRepo implements UserRepositoryInterface 
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}