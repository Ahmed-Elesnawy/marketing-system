<?php


namespace App\Repositories;

use App\Province;
use App\Repositories\Contracts\ProvinceRepositoryInterface;


class ProvinceRepository extends AbstractRepo implements ProvinceRepositoryInterface
{
    protected $model;

    public function __construct(Province $model)
    {
        $this->model = $model;
    }


    public function getProvinceChoices()
    {
    	return $this->model->pluck('name','id');
    }


   
}