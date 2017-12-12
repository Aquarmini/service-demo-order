<?php
// +----------------------------------------------------------------------
// | AppHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Thrift\Services;

use App\Biz\CartService\Cart;
use Xin\Thrift\OrderService\OrderIf;
use Xin\Thrift\OrderService\ThriftException;

class OrderHandler extends Handler implements OrderIf
{
    /**
     * @desc   返回项目版本号
     * @author limx
     * @return mixed
     * @throws ThriftException
     */
    public function version()
    {
        return $this->config->version;
    }

    /**
     * @desc   添加购物车
     * @author limx
     * @param int $userId  用户ID
     * @param int $goodsId 商品ID
     * @return bool
     */
    public function addGoodsToCart($userId, $goodsId)
    {
        $result = Cart::getInstance()->add($userId, $goodsId);
        return $result;
    }

    /**
     * @desc   从购物车中删除商品
     * @author limx
     * @param int $userId
     * @param int $goodsId
     * @return bool
     */
    public function delGoodsFromCart($userId, $goodsId, $id)
    {
        $result = Cart::getInstance()->del($userId, $goodsId, $id);
        return $result;
    }
}