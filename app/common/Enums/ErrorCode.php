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
}