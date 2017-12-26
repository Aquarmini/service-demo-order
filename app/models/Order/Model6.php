<?php
namespace App\Models\Order;

use App\Models\Order as OrderBase;
use App\Models\OrderInfo\Model6 as OrderInfo;

class Model6 extends OrderBase {
    
    public function getSchema()
    {
        return 'order_6';
    }
    
    public function initialize()
    {
        $this->hasOne('id', OrderInfo::class, 'id', ['alias' => 'info', 'reusable' => true]);
        parent::initialize();
    }
    
}