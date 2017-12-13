<?php
namespace App\Models\Cart;

use App\Models\Cart as CartBase;

class Model3 extends CartBase {
    
    public function getSchema()
    {
        return 'order_3';
    }
}