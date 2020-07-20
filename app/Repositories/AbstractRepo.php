<?php 



namespace App\Repositories;


abstract class AbstractRepo 
{

    public function create($data)
    {
       return $this->model->create($data);
    }

    public function update($object,$data)
    {
        $object->update($data);
    }

    public function delete($object)
    {
        $object->delete();
    }

}