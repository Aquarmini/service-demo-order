<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model1 as OrderInfo;

class Model1 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_1';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id', ['alias' => 'info', 'reusable' => true]);
        parent::initialize();
    }
    
}