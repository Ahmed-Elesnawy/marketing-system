<?php

namespace App\Services;

use App\Repositories\Contracts\ColorRepositoryInterface;


class ColorService 
{
    private $colorRepo;

    public function __construct(ColorRepositoryInterface $colorRepo)
    {
        $this->colorRepo = $colorRepo;
    }

    public function store($request)
    {
        $this->colorRepo->create($this->data($request));
    }


    public function update($request,$color)
    {
        $this->colorRepo->update($color,$this->data($request));
    }

    public function destroy($color)
    {
        $this->colorRepo->delete($color);
    }


    private function data($request)
    {
        return $request->validated();
    }


    

    
}