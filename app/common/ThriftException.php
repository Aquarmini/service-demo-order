<?php
// +----------------------------------------------------------------------
// | ThriftException.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common;

use Xin\Phalcon\Logger\Factory;
use Xin\Thrift\OrderService\ThriftException as BaseException;

class ThriftException extends BaseException
{
    public function __construct($vals = null)
    {
        /** @var Factory $factory */
        $factory = di('logger');
        $logger = $factory->getLogger('thrift-exception');
        $message = 'code:' . $vals['code'] . '|message:' . $vals['message'];
        $logger->error($message);
        parent::__construct($vals);
    }

}