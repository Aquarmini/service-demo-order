<?php
// +----------------------------------------------------------------------
// | EditTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Cart;

use App\Thrift\Clients\OrderClient;
use Tests\Units\BaseTest;

class EditTest extends BaseTest
{
    public function testAddCartCase()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId);
        $this->assertTrue($status);
    }

    public function testDelCartCase()
    {
        $client = OrderClient::getInstance();
        $status = $client->delGoodsFromCart($this->userId, $this->goodsId);
        $this->assertTrue($status);
    }
}
