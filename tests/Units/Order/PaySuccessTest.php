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

class PaySuccessTest extends BaseTest
{
    public function testPaySuccess()
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
            $client->paySuccess($order_id);
        } catch (\Exception $ex) {
            $this->assertEquals(ErrorCode::$ENUM_ORDER_ONLY_PAYID_ONCE, $ex->getCode());
            $message = ErrorCode::getMessage(ErrorCode::$ENUM_ORDER_ONLY_PAYID_ONCE);
            $this->assertEquals($message, $ex->getMessage());
        }
    }
}