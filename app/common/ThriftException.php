<?php
// +----------------------------------------------------------------------
// | ThriftException.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common;

use App\Common\Enums\ErrorCode;
use Xin\Phalcon\Logger\Factory;
use Xin\Thrift\OrderService\ThriftException as BaseException;

class ThriftException extends BaseException
{
    public function __construct($code = 400, $message = null)
    {
        if (empty($message)) {
            $message = ErrorCode::getMessage($code);
        }
        /** @var Factory $factory */
        $factory = di('logger');
        $logger = $factory->getLogger('thrift-exception');
        $logger->error('code:' . $code . '|message:' . $message);
        parent::__construct([
            'code' => $code,
            'message' => $message,
        ]);
    }

}