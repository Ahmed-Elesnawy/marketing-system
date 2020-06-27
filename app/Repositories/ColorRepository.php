<?php


namespace App\Repositories;

use App\Color;
use App\Repositories\Contracts\ColorRepositoryInterface;


class ColorRepository extends AbstractRepo implements ColorRepositoryInterface 
{
    protected $model;

    public function __construct(Color $model)
    {
        $this->model = $model;
    }
}