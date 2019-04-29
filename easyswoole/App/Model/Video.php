<?php

namespace App\Model;

use App\Lib\Mysql\Model;

/**
 *  Video数据模型
 */
class Video extends Model
{
    public function getHot($num = 10, $field = null)
    {
        $model = $this->order('zan DESC')->where('status', 0);
        if (!empty($num)) {
            $model = $model->limit($num);
        }

        if (!empty($field)) {
            $model = $model->field($field);
        }

        return $model->select();
    }
}
