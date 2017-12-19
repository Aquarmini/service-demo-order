<?php
// +----------------------------------------------------------------------
// | Order.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\OrderService;

use App\Models\Model;
use App\Utils\Log;
use Phalcon\Di\Injectable;
use Xin\Traits\Common\InstanceTrait;
use App\Models\Order as OrderModel;

class Order extends Injectable
{
    use InstanceTrait;

    /**
     * @desc   下单接口
     * @author limx
     * @param       $userId
     * @param array $cartIds
     * @return bool
     */
    public function place($userId, array $cartIds)
    {
        return true;
    }
}