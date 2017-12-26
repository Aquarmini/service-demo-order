<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model4 as OrderInfo;

class Model4 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_4';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id');
        parent::initialize();
    }
    
}