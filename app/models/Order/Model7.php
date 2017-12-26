<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model7 as OrderInfo;

class Model7 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_7';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id');
        parent::initialize();
    }
    
}