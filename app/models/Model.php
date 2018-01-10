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
use Phalcon\Text;
use Xin\Phalcon\Logger\Sys as LogSys;
use App\Core\Mvc\Model as BaseModel;

abstract class Model extends BaseModel
{
    const DELETED = 1;

    const NOT_DELETED = 0;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
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
        $id = $validator->getValue('id');
        $user_id = $validator->getValue('user_id');
        $schema_id = get_schema_id($id, $user_id);
        $className = 'Model' . $schema_id;
        $class = sprintf("%s\\%s", get_called_class(), $className);
        return new $class;
    }

    public function getSchema()
    {
        throw new CodeException(ErrorCode::$ENUM_MODEL_SCHEMA_MUST_REWRITE);
    }

    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        $this->updated_at = date('Y-m-d H:i:s');
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
