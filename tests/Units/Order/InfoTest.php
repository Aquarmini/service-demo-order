<?php
// +----------------------------------------------------------------------
// | PlaceTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Cart;

use App\Common\Enums\ErrorCode;
use App\Models\Cart;
use App\Models\Model;
use App\Thrift\Clients\OrderClient;
use Tests\Units\BaseTest;
use Xin\Thrift\OrderService\ThriftException;

class InfoTest extends BaseTest
{
    public function testInfo()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId, $this->shopId, 4, $this->fee);
        $this->assertTrue($status);
        $result = $client->listCartsByUserId($this->userId, 10, null);
        $cartIds = [];
        foreach ($result->items as $item) {
            $cartIds[] = $item->id;
        }
        $order_id = $client->place($this->userId, $cartIds);
        $this->assertTrue($order_id > 0);

        $info = $client->getOrderInfo($order_id);
        $this->assertTrue($info instanceof \Xin\Thrift\OrderService\Order\OrderInfo);

        try {
            $info = $client->getOrderInfo(12346578909);
        } catch (\Exception $ex) {
            $this->assertEquals(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST, $ex->getCode());
            $this->assertEquals(ErrorCode::getMessage(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST), $ex->getMessage());
        }

        try {
            $info = $client->getOrderInfo(12346578909333);
        } catch (ThriftException $ex) {
            $this->assertEquals(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST, $ex->getCode());
            $this->assertEquals(ErrorCode::getMessage(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST), $ex->getMessage());
        }
    }
}