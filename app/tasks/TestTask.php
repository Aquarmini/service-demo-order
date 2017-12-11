<?php

namespace App\Tasks;

use App\Common\Validator\Database\ConfigValidator;
use App\Models\Order;
use App\Thrift\Clients\OrderClient;

class TestTask extends Task
{

    public function mainAction()
    {
        $client = OrderClient::getInstance();
        dd($client->addGoodsToCart(1,1));
    }

}

