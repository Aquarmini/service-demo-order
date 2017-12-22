<?php
// +----------------------------------------------------------------------
// | PlaceTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Cart;

use App\Models\Cart;
use App\Models\Model;
use App\Thrift\Clients\OrderClient;
use Tests\Units\BaseTest;

class ListTest extends BaseTest
{
    public function testList()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId, $this->shopId, 1, $this->fee);
        $this->assertTrue($status);
        $result = $client->listCartsByUserId($this->userId, 10, null);
        $cartIds = [];
        foreach ($result->items as $item) {
            $cartIds[] = $item->id;
        }
        $this->assertTrue($client->place($this->userId, $cartIds));
        $result = $client->listOrderByUserId($this->userId, 10, null);
        $this->assertTrue($result instanceof \Xin\Thrift\OrderService\Order\OrderList);
        $this->assertTrue(count($result->items) > 0);
        $this->assertTrue($result->items[0] instanceof \Xin\Thrift\OrderService\Order\Order);
    }
}