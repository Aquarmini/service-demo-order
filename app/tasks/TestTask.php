<?php

namespace App\Tasks;

use App\Common\Validator\Database\ConfigValidator;
use App\Models\Order;

class TestTask extends Task
{

    public function mainAction()
    {
        dd(get_order_id(88888));
    }

}

