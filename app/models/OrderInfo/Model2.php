<?php
namespace App\Models\OrderInfo;

use App\Models\OrderInfo as OrderInfoBase;

class Model2 extends OrderInfoBase
{
    public function getSchema()
    {
        return 'order_2';
    }
}
