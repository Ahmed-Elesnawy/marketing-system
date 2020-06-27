<?php


namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{
    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }


    public function store($request)
    {
        
        $this->categoryRepo->create($this->data($request));
    }


    public function update($request,$category)
    {
        $this->categoryRepo->update($category,$this->data($request));
    }


    public function destroy($category)
    {
        $this->categoryRepo->delete($category);
    }


    private function data($request)
    {
        return $request->validated();
    }
}
