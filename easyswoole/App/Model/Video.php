<?php

namespace App\Model;

use App\Lib\Mysql\Model;

/**
 *  Video数据模型
 */
class Video extends Model
{
    /**
     * 获取最热视频
     * @param  integer $num   [description]
     * @param  [type]  $field [description]
     * @return [type]         [description]
     */
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

    /**
     *
     * @param [type] $data [description]
     */
    public function addVideo($data)
    {
        return $this->insert($data);
    }
}
