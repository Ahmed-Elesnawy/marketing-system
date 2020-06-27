<?php


namespace App\Services;

use App\Repositories\Contracts\ProvinceRepositoryInterface;

class ProvinceService
{
    private $provinceRepo;

    public function __construct(ProvinceRepositoryInterface $provinceRepo)
    {
        $this->provinceRepo = $provinceRepo;
    }


    public function store($request)
    {
        $this->provinceRepo->create($this->data($request));
    }


    public function update($province,$request)
    {
        $this->provinceRepo->update($province,$this->data($request));
    }


    public function destroy($province)
    {
        $this->provinceRepo->delete($province);
    }




    protected function data($request)
    {
        return $request->validated();
    }


    
}
