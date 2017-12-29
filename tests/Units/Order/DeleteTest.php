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
use App\Common\Enums\OrderCode;
use App\Thrift\Clients\OrderClient;
use Tests\Units\BaseTest;
use Xin\Thrift\OrderService\Order\PlaceInput;

class DeleteTest extends BaseTest
{
    public function testDelete()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId, $this->shopId, 2, $this->fee);
        $this->assertTrue($status);
        $result = $client->listCartsByUserId($this->userId, 10, null);
        $cartIds = [];
        foreach ($result->items as $item) {
            $cartIds[] = $item->id;
        }
        $input = new PlaceInput([
            'userId' => $this->userId,
            'cartIds' => $cartIds,
        ]);
        $order_id = $client->place($input);
        $this->assertTrue($order_id > 0);

        $this->assertTrue($client->delOrder($order_id));
    }

    public function testDeletePaid()
    {
        $client = OrderClient::getInstance();
        $status = $client->addGoodsToCart($this->userId, $this->goodsId, $this->shopId, 2, $this->fee);
        $this->assertTrue($status);
        $result = $client->listCartsByUserId($this->userId, 10, null);
        $cartIds = [];
        foreach ($result->items as $item) {
            $cartIds[] = $item->id;
        }
        $input = new PlaceInput([
            'userId' => $this->userId,
            'cartIds' => $cartIds,
        ]);
        $order_id = $client->place($input);
        $this->assertTrue($order_id > 0);

        $this->assertTrue($client->paySuccess($order_id));

        try {
            $client->delOrder($order_id);
        } catch (\Exception $ex) {
            $code = ErrorCode::$ENUM_ORDER_NOT_ALLOWED_DELETE_PAYID;
            $this->assertEquals($code, $ex->getCode());
            $message = ErrorCode::getMessage($code);
            $this->assertEquals($message, $ex->getMessage());
        }
    }
}
