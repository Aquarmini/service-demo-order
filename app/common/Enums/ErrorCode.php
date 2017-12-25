<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('DB服务初始化失败')
     */
    public static $ENUM_SERVICE_DB_INIT_ERROR = 401;

    /**
     * @Message('模型的getSchema方法必须被重写')
     */
    public static $ENUM_MODEL_SCHEMA_MUST_REWRITE = 402;

    /**
     * @Message('订单下单报错，非法的购物车ID')
     */
    public static $ENUM_ORDER_PLACE_INVALID_CART_ID = 1001;

    /**
     * @Message('订单下单失败')
     */
    public static $ENUM_ORDER_PLACE_ERROR = 1002;

    /**
     * @Message('订单不存在')
     */
    public static $ENUM_ORDER_IS_NOT_EXIST = 1003;

    /**
     * @Message('订单不允许重复支付')
     */
    public static $ENUM_ORDER_ONLY_PAYID_ONCE = 1004;

    /**
     * @Message('不允许删除已支付订单')
     */
    public static $ENUM_ORDER_NOT_ALLOWED_DELETE_PAYID = 1005;
}