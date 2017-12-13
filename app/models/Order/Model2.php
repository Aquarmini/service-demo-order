<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;

class Model2 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_2';
    }
}