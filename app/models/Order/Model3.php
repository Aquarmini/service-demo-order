<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model3 as OrderInfo;

class Model3 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_3';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id');
        parent::initialize();
    }
    
}