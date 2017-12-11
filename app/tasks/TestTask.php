<?php

namespace App\Tasks;

use App\Common\Validator\Database\ConfigValidator;
use App\Models\Order;

class TestTask extends Task
{

    public function mainAction()
    {
        $order_id = get_order_id(88889);
        dump($order_id);
        $schema = get_schema($order_id);
        dump($schema);
    }

}

