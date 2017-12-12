<?php
// +----------------------------------------------------------------------
// | Model基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
namespace App\Models;

use App\Common\CodeException;
use App\Common\Enums\ErrorCode;
use App\Common\Validator\Database\ConfigValidator;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Xin\Phalcon\Logger\Sys as LogSys;

/**
 * Class Model
 * @package App\Models
 */
abstract class Model extends \Phalcon\Mvc\Model
{
    const DELETED = 1;

    const NOT_DELETED = 0;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        // 模型关系
        // $options=['alias' => 'user', 'reusable' => true] alias:别名 reusable:模型是否复用
        // $this->hasOne(...$params, $options = null)
        // $this->belongsTo(...$params, $options = null)
        // $this->hasMany(...$params, $options = null)
        // $this->hasManyToMany(...$params, $options = null)

        // Sets if a model must use dynamic update instead of the all-field update
        $this->useDynamicUpdate(true);

        // 增加Soft Delete
        $this->addBehavior(
            new SoftDelete(
                [
                    'field' => 'is_deleted',
                    'value' => static::DELETED,
                ]
            )
        );

    }

    /**
     * @desc   获取Model
     * @author limx
     * @param array $config
     * @return static
     * @throws CodeException
     */
    public static function getInstance($config = [])
    {
        $validator = new ConfigValidator();
        if ($validator->validate($config)->valid()) {
            throw new CodeException(ErrorCode::$ENUM_SERVICE_DB_INIT_ERROR, $validator->getErrorMessage());
        }
        $model = new static();
        $id = $validator->getValue('id');
        $user_id = $validator->getValue('user_id');
        $schema = get_schema($id, $user_id);
        $model->setSchema($schema);
        return $model;
    }

    /**
     * @desc   只修改某些字段的更新方法
     * @author limx
     * @param      $data
     * @param null $whiteList
     * @return bool
     */
    public function updateOnly($data, $whiteList = null)
    {
        $attributes = $this->getModelsMetaData()->getAttributes($this);
        $this->skipAttributesOnUpdate(array_diff($attributes, array_keys($data)));

        return parent::update($data, $whiteList);
    }

    public function beforeCreate()
    {
        // 数据创建之前
    }

    public function beforeUpdate()
    {
        // 数据更新之前
    }

    public function afterSave()
    {
        // 数据修改之后
    }

    /**
     * @desc   验证失败之后的事件
     * @author limx
     */
    public function onValidationFails()
    {
        $logger = di('logger')->getLogger('sql', LogSys::LOG_ADAPTER_FILE);
        $class = get_class($this);
        foreach ($this->getMessages() as $message) {
            $logger->error(sprintf("\n模型:%s\n错误信息:%s\n\n", $class, $message->getMessage()));
        }
    }

}
