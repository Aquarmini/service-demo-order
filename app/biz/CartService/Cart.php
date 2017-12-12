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
use App\Models\Cart as CartModel;

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
        $cart = CartModel::getInstance([
            'user_id' => $userId
        ]);

        $cart->user_id = $userId;
        $cart->goods_id = $goodsId;

        return $cart->save();
    }

    /**
     * @desc   从购物车中删除商品
     * @author limx
     * @param $userId
     * @param $goodsId
     * @return bool
     */
    public function del($userId, $goodsId)
    {
        $model = CartModel::getInstance([
            'user_id' => $userId
        ]);

        $cart = $model->findFirst([
            'conditions' => 'user_id = ?0 AND goods_id = ?1',
            'bind' => [$userId, $goodsId],
        ]);

        if ($cart) {
            return $cart->delete();
        }

        return false;
    }
}