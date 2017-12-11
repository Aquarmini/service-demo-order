<?php
// +----------------------------------------------------------------------
// | InitValidator.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Validator\Database;

use App\Core\Validation\Validator;
use Phalcon\Validation\Validator\Callback as CallbackValidator;

class ConfigValidator extends Validator
{
    public function initialize()
    {
        $this->add(
            ["user_id", "id"],
            new CallbackValidator(
                [
                    "message" => "There must be only an user or admin set",
                    "callback" => function ($data) {

                        if (empty($data['user_id']) && empty($data['id'])) {
                            return false;
                        }

                        return true;
                    }
                ]
            )
        );
    }

}