<?php


namespace App\Repositories;

use App\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class CategoryRepository extends AbstractRepo implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}