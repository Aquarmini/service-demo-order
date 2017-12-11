<?php

namespace App\Thrift\Clients;

use App\Thrift\Client;
use Xin\Thrift\Order\OrderClient as OrderServiceClient;

class OrderClient extends Client
{
    protected $host = '127.0.0.1';

    protected $port = '52103';

    protected $service = 'order';

    protected $clientName = OrderServiceClient::class;

    protected $recvTimeoutMilliseconds = 50;

    protected $sendTimeoutMilliseconds;

    /**
     * @desc
     * @author limx
     * @param array $config
     * @return OrderServiceClient
     */
    public static function getInstance($config = [])
    {
        return parent::getInstance($config);
    }


}

