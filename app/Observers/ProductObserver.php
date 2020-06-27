<?php

namespace App\Observers;

class ProductObserver
{
    public function deleted($product)
    {
        check_file($product->image);
    }
}
