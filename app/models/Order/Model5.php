<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model5 as OrderInfo;

class Model5 extends OrderBase
{
    public function getSchema()
    {
        return 'order_5';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id', ['alias' => 'info', 'reusable' => true]);
        parent::initialize();
    }
}
