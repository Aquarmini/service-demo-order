<?php
// +----------------------------------------------------------------------
// | Cart.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\CartService;

use App\Models\Model;
use App\Utils\Log;
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
     * @desc   返回用户的购物车列表
     * @author limx
     * @param $userId      用户ID
     * @param $lastQueryId 上次最后的查询ID
     * @param $pageSize    分页大小
     * @return CartModel|CartModel[]|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public function listByUserId($userId, $pageSize, $lastQueryId = null)
    {
        $cart = CartModel::getInstance([
            'user_id' => $userId
        ]);
        Log::info($cart->getSchema());
        $condition = 'user_id = ?0 AND order_id IS NULL AND is_deleted = ?1';
        $bind = [$userId, Model::NOT_DELETED];
        if (isset($lastQueryId)) {
            $condition .= ' AND id < ?2';
            $bind[] = $lastQueryId;
        }

        return $cart->find([
            'conditions' => $condition,
            'bind' => $bind,
            'limit' => $pageSize,
            'order' => 'id DESC',
        ]);
    }

    /**
     * @desc   从购物车中删除商品
     * @author limx
     * @param $userId
     * @param $goodsId
     * @return bool
     */
    public function del($userId, $goodsId, $id)
    {
        $model = CartModel::getInstance([
            'user_id' => $userId
        ]);

        $cart = $model->findFirst([
            'conditions' => 'user_id = ?0 AND goods_id = ?1 AND id = ?2',
            'bind' => [$userId, $goodsId, $id],
        ]);

        if ($cart) {
            return $cart->delete();
        }

        return false;
    }
}