<?php
// +----------------------------------------------------------------------
// | test.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
class Order extends \Phalcon\Mvc\Model
{
    public $id;
    public $oid;

    public function getSchema()
    {
        if ($this->oid % 2 === 0) {
            return 'test2';
        } else {
            return 'test1';
        }
    }

    public function getInstance($oid)
    {
        $model = new static();
        $model->oid = $oid;
        return $model;
    }
}

$res = Order::find([
    'conditions' => 'id = ?0',
    'bind' => [1],
    'schema' => 'test2'
]);