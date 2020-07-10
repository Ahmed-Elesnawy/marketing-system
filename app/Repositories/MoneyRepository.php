<?php


namespace App\Repositories;

use App\MoneyRequest;
use App\Repositories\Contracts\MoneyRepositoryInterface;



class MoneyRepository extends AbstractRepo implements MoneyRepositoryInterface
{
    protected $model;

    public function __construct(MoneyRequest $model)
    {
        $this->model = $model;
    }


    public function getPaginatedRequests($num=10)
    {
    	return $this->model->with('user')->latest()->paginate($num);
    }
}