<?php
namespace App\Models\OrderInfo;

use App\Models\OrderInfo as OrderInfoBase;

class Model1 extends OrderInfoBase
{
    public function getSchema()
    {
        return 'order_1';
    }
}
