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
    public function getAllCategory($field = false, $pid = 0)
    {
        if ($field === false) {
            $res = $this
                ->where('pid', $pid)
                ->order('weigh desc')
                ->where('status', 0)
                ->select();
        } else {
            $res = $this
                ->where('pid', $pid)
                ->order('weigh desc')
                ->where('status', 0)
                ->field($field)
                ->select();
        }
        return $res;
    }
}
