<?php

namespace App\Observers;

use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating($category)
    {
        $category->slug = Str::slug($category->name_en);
    }

    public function updating($category)
    {
        $category->slug = Str::slug($category->name_en);
    }
}
