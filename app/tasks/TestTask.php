<?php

namespace App\Tasks;

use App\Common\Validator\Database\ConfigValidator;
use App\Models\Order;
use App\Thrift\Clients\OrderClient;

class TestTask extends Task
{

    public function mainAction()
    {
        // dd(get_schema(null, 88812));
        $client = OrderClient::getInstance();
        dd($client->addGoodsToCart(1003, 1));
    }

}

