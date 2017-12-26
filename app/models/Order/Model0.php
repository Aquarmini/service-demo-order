<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model0 as OrderInfo;

class Model0 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_0';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id', ['alias' => 'info', 'reusable' => true]);
        parent::initialize();
    }
    
}