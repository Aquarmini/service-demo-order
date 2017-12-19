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
        $result = $client->listCartsByUserId($this->userId, 10, null);
        if (count($result->items) > 0) {
            $cartIds = [];
            foreach ($result->items as $item) {
                $cartIds[] = $item->id;
            }
            $this->assertTrue($client->place($this->userId, $cartIds));
        }
    }
}