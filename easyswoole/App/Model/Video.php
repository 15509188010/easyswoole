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
    public function getHot($num = 10, $field = null, $orderby = 'zan DESC')
    {
        $model = $this->order($orderby)->where('status', 0);
        if (!empty($num)) {
            $model = $model->limit($num);
        }

        if (!empty($field)) {
            $model = $model->field($field);
        }

        return $model->select();
    }

    /**
     * 写入数据
     * @param [type] $data [description]
     */
    public function addVideo($data)
    {
        return $this->insert($data);
    }

    /**
     * 获取指定id的视屏信息
     * @param  [type] $id    [description]
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function getVideoInfo($id, $field = null)
    {
        $model = $this->where('id', $id);
        if (!empty($field)) {
            $model = $model->field($field);
        }

        return $model->find();
    }
}
