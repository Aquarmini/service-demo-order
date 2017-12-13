<?php
namespace App\Models\Cart;

use App\Models\Cart as CartBase;

class Model1 extends CartBase {
    
    public function getSchema()
    {
        return 'order_1';
    }
}