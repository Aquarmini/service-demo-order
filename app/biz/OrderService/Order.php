<?php
// +----------------------------------------------------------------------
// | Order.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\OrderService;

use App\Common\Enums\ErrorCode;
use App\Common\Enums\OrderCode;
use App\Models\Model;
use App\Models\OrderInfo as OrderInfoModel;
use App\Utils\DB;
use Phalcon\Di\Injectable;
use App\Common\ThriftException;
use Xin\Traits\Common\InstanceTrait;
use App\Models\Order as OrderModel;
use App\Models\Cart as CartModel;

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
    public function place($userId, array $cartIds, $remark = '')
    {
        // 判断cartId是否与userId匹配
        $cartModel = CartModel::getInstance([
            'user_id' => $userId
        ]);
        /** @var CartModel[] $carts */
        $carts = [];
        $totalFee = 0;
        foreach ($cartIds as $cartId) {
            $cart = $cartModel->findFirst($cartId);
            if ($cart->user_id !== $userId) {
                throw new ThriftException(ErrorCode::$ENUM_ORDER_PLACE_INVALID_CART_ID);
            }
            $carts[] = $cart;
            $totalFee += $cart->unit_fee * $cart->num;
        }

        $order_id = get_order_id($userId);
        DB::begin();
        try {
            $orderModel = OrderModel::getInstance([
                'user_id' => $userId
            ]);

            $orderModel->id = $order_id;
            $orderModel->user_id = $userId;
            $orderModel->total_fee = $totalFee;
            if ($orderModel->save()) {
                // 订单保存成功 修改购物车状态
                foreach ($carts as $cart) {
                    $cart->order_id = $orderModel->id;
                    if (false === $cart->save()) {
                        $message = [];
                        foreach ($cart->getMessages() as $item) {
                            $message[] = $item->getMessage();
                        }
                        throw new \Exception(implode(',', $message));
                    }
                }
            }

            $orderInfoModel = OrderInfoModel::getInstance([
                'id' => $order_id,
            ]);
            $orderInfoModel->id = $order_id;
            $orderInfoModel->remark = $remark;
            if (!$orderInfoModel->save()) {
                throw new \Exception('订单详情保存失败');
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw new ThriftException(ErrorCode::$ENUM_ORDER_PLACE_ERROR, $ex->getMessage());
        }

        return $order_id;
    }

    /**
     * @desc   返回用户订单列表
     * @author limx
     * @param      $userId
     * @param      $pageSize
     * @param null $lastQueryId
     * @return OrderModel|OrderModel[]|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public function listOrderByUserId($userId, $pageSize, $lastQueryId = null)
    {
        $orderModel = OrderModel::getInstance([
            'user_id' => $userId
        ]);

        $condition = 'user_id = ?0 AND is_deleted = ?1';
        $bind = [$userId, Model::NOT_DELETED];
        if (isset($lastQueryId)) {
            $condition .= ' AND id < ?2';
            $bind[] = $lastQueryId;
        }

        return $orderModel->find([
            'conditions' => $condition,
            'bind' => $bind,
            'limit' => $pageSize,
            'order' => 'id DESC',
        ]);
    }

    /**
     * @desc   订单详情
     * @author limx
     * @param $orderId
     * @return OrderModel
     * @throws ThriftException
     */
    public function getOrderInfo($orderId)
    {
        $orderModel = OrderModel::getInstance([
            'id' => $orderId
        ]);

        $res = $orderModel->findFirst([
            'conditions' => 'id = ?0 AND is_deleted = ?1',
            'bind' => [$orderId, Model::NOT_DELETED],
        ]);
        if (empty($res)) {
            throw new ThriftException(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST);
        }

        return $res;
    }

    /**
     * @desc   订单支付完成修改订单状态
     * @author limx
     * @param $orderId
     * @return bool
     * @throws ThriftException
     */
    public function paySuccess($orderId)
    {
        $orderModel = OrderModel::getInstance([
            'id' => $orderId
        ]);

        $order = $orderModel->findFirst([
            'conditions' => 'id = ?0 AND is_deleted = ?1',
            'bind' => [$orderId, Model::NOT_DELETED],
        ]);
        if (empty($order)) {
            throw new ThriftException(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST);
        }

        if ($order->status === OrderCode::STATUS_PAID) {
            throw new ThriftException(ErrorCode::$ENUM_ORDER_ONLY_PAYID_ONCE);
        }

        $order->status = OrderCode::STATUS_PAID;

        return $order->save();
    }

    /**
     * @desc   删除未支付订单
     * @author limx
     * @param $orderId
     * @return bool
     * @throws ThriftException
     */
    public function delOrder($orderId)
    {
        $orderModel = OrderModel::getInstance([
            'id' => $orderId
        ]);

        $order = $orderModel->findFirst($orderId);
        if (empty($order)) {
            throw new ThriftException(ErrorCode::$ENUM_ORDER_IS_NOT_EXIST);
        }

        if ($order->status === OrderCode::STATUS_PAID) {
            throw new ThriftException(ErrorCode::$ENUM_ORDER_NOT_ALLOWED_DELETE_PAYID);
        }

        return $order->delete();
    }
}