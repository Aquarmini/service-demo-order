<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model2 as OrderInfo;

class Model2 extends OrderBase
{
    public function getSchema()
    {
        return 'order_2';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id', ['alias' => 'info', 'reusable' => true]);
        parent::initialize();
    }
}
