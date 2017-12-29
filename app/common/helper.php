<?php
// +----------------------------------------------------------------------
// | helper.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use App\Common\OrderClient;
use App\Common\Enums\AppCode;

if (!function_exists('get_schema')) {
    /**
     * @desc   根据订单ID或者用户ID获取数据库名
     * @author limx
     * @param $id
     * @param $userId
     * @return mixed
     */
    function get_schema($id = null, $userId = null)
    {
        $id = get_schema_id($id, $userId);
        return sprintf(AppCode::DB_ORDER_SUFFIX, $id);
    }
}

if (!function_exists('get_schema_id')) {
    /**
     * @desc   根据订单ID或者用户ID获取数据库名
     * @author limx
     * @param $id
     * @param $userId
     * @return mixed
     */
    function get_schema_id($id = null, $userId = null)
    {
        if (isset($id)) {
            $num = str_pad(decbin($id), 64, '0', STR_PAD_LEFT);
            $bit = substr($num, 42, 10); // userId 的10个bit位
            $bit = substr($bit, -3, 3);
            return bindec($bit);
        }

        $bit = decbin($userId);
        $bit = substr($bit, -3, 3);
        return bindec($bit);
    }
}

if (!function_exists('get_order_id')) {
    /**
     * @desc   根据订单ID或者用户ID获取数据库名
     * @author limx
     * @param $id
     * @param $userId
     * @return mixed
     */
    function get_order_id($userId)
    {
        return OrderClient::getInstance()->id($userId % 1024, rand(0, 4095));
    }
}
