<?php

namespace App\Tasks\Make;

use App\Common\Enums\App;
use App\Tasks\Task;
use Xin\Cli\Color;
use Xin\Support\File;

class OrderInfoTask extends Task
{

    public function mainAction()
    {
        $template = $this->getTemplate();
        for ($i = 0; $i < 8; $i++) {
            $dir = 'OrderInfo';
            $class = 'Model' . $i;
            $schema = sprintf(App::DB_ORDER_SUFFIX, $i);
            $result = str_replace('%CLASS%', $class, $template);
            $result = str_replace('%SCHEMA%', $schema, $result);
            $path = APP_PATH . '/models/' . $dir;
            if (!is_dir($path)) {
                File::getInstance()->makeDirectory($path);
            }
            file_put_contents($path . "/{$class}.php", $result);
        }
        echo Color::success('模型创建成功') . PHP_EOL;
    }

    public function getTemplate()
    {
        return "<?php
namespace App\Models\OrderInfo;

use App\Models\OrderInfo as OrderInfoBase;

class %CLASS% extends OrderInfoBase {
    
    public function getSchema()
    {
        return '%SCHEMA%';
    }
}";
    }

}

