<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;

class Model3 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_3';
    }
}