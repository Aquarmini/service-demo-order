<?php

namespace App\Tasks;

use App\Models\Order;

class TestTask extends Task
{

    public function mainAction()
    {
        $res = Order::find()->toArray();
        dd($res);
    }

}

