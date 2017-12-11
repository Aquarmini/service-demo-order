<?php
// +----------------------------------------------------------------------
// | Cart.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\CartService;

use Phalcon\Di\Injectable;
use Xin\Traits\Common\InstanceTrait;

class Cart extends Injectable
{
    use InstanceTrait;

    /**
     * @desc   添加购物车
     * @author limx
     * @param $userId
     * @param $goodsId
     * @return bool
     */
    public function add($userId, $goodsId)
    {
        return true;
    }
}