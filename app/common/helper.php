<?php
// +----------------------------------------------------------------------
// | helper.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use App\Common\OrderClient;

if (!function_exists('get_schema')) {
    /**
     * @desc   根据订单ID或者用户ID获取数据库名
     * @author limx
     * @param $id
     * @param $userId
     * @return mixed
     */
    function get_schema($id, $userId)
    {

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