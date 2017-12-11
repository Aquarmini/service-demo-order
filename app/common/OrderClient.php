<?php
// +----------------------------------------------------------------------
// | Order.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common;

use Xin\Snowflake\Client;

class OrderClient extends Client
{
    public function getBeginAt()
    {
        return strtotime('2017-12-01');
    }
}