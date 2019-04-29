<?php

namespace App\Model;

use App\Lib\Mysql\Model;

/**
 *  Appkey数据模型
 */
class Appkey extends Model
{
    public function getAppkey($appkey, $field = false)
    {
        $model = $this->where('appkey', $appkey);
        if ($field !== false) {
            $model = $model->field($field);
        }
        return $model->find();
    }
}
