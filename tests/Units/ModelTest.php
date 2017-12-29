<?php
// +----------------------------------------------------------------------
// | ModelTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

use App\Common\OrderClient;
use App\Models\Order;

class EditTest extends BaseTest
{
    public function testSchemaCase()
    {
        $order1 = Order::getInstance([
            'user_id' => 1,
        ]);

        $order2 = Order::getInstance([
            'user_id' => 2,
        ]);

        $this->assertEquals($order2->getSchema(), get_schema(null, 2));
        $this->assertEquals($order1->getSchema(), get_schema(null, 1));
    }
}
