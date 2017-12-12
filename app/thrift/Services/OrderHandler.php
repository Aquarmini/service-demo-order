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
use Xin\Thrift\OrderService\Order\CartList;
use Xin\Thrift\OrderService\OrderIf;
use Xin\Thrift\OrderService\ThriftException;
use Xin\Thrift\OrderService\Order\Cart as CartDTO;

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
     * @desc   获取用户购物车列表
     * @author limx
     * @param int $userId
     * @param int $lastQueryId
     * @param int $pageSize
     * @return CartList
     */
    public function listCartsByUserId($userId, $pageSize, $lastQueryId)
    {
        $carts = Cart::getInstance()->listByUserId($userId, $pageSize, $lastQueryId);
        $items = [];
        foreach ($carts as $cart) {
            $item = new CartDTO([
                'id' => $cart->id,
                'userId' => $cart->user_id,
                'orderId' => $cart->order_id,
                'goodsId' => $cart->goods_id,
                'isDeleted' => $cart->is_deleted,
            ]);
            $items[] = $item;
        }
        return new CartList([
            'items' => $items
        ]);
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