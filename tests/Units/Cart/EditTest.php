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
use UnitTestCase;

class EditTest extends UnitTestCase
{
    public function testAddCartCase()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart(11521, 110536);
        $this->assertTrue($status);
    }
}
