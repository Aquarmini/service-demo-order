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
use App\Utils\DB;
use Phalcon\Di\Injectable;
use Xin\Thrift\OrderService\ThriftException;
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
    public function place($userId, array $cartIds)
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
                throw new ThriftException([
                    'code' => ErrorCode::$ENUM_ORDER_PLACE_INVALID_CART_ID,
                    'message' => ErrorCode::getMessage(ErrorCode::$ENUM_ORDER_PLACE_INVALID_CART_ID),
                ]);
            }
            $carts[] = $cart;
            $totalFee += $cart->unit_fee * $cart->num;
        }

        DB::begin();
        try {
            $orderModel = OrderModel::getInstance([
                'user_id' => $userId
            ]);

            $orderModel->id = get_order_id($userId);
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
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw new ThriftException([
                'code' => ErrorCode::$ENUM_ORDER_PLACE_ERROR,
                'message' => $ex->getMessage(),
            ]);
        }

        return true;
    }
}