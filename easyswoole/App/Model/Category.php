<?php

namespace App\Model;

use App\Lib\Mysql\Model;

/**
 *  Category数据模型
 */
class Category extends Model
{
    /**
     * 获取所有一级分类
     * @return [type] [description]
     */
    public function getAllCategory($field = false, $item = false, $pid = 0)
    {
        $model = $this->order('weigh desc')->where('pid', $pid)->order('weigh DESC');
        if ($field !== false) {
            $model = $model->field($field);
        }

        if ($item !== false) {
            $model = $model->where('item', $item);
        }

        $res = $model->select();

        return $res;
    }
}
