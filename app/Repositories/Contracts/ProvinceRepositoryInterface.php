<?php 



namespace App\Repositories\Contracts;




interface ProvinceRepositoryInterface
{
    public function create($data);

    public function update($category,$data);

    public function delete($category);

    public function getProvinceChoices();
}