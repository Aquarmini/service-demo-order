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

class PlaceTest extends BaseTest
{
    public function testPlace()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId, $this->shopId, 2, $this->fee);
        $this->assertTrue($status);
        $result = $client->listCartsByUserId($this->userId, 10, null);
        $cartIds = [];
        foreach ($result->items as $item) {
            $cartIds[] = $item->id;
        }
        $order_id = $client->place($this->userId, $cartIds);
        $this->assertTrue($order_id > 0);
    }
}