<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\Http\Message\Status;

/**
 * date:2019-04-28
 * author:ming
 * Slide模块
 */
class Slide extends Base
{
    /**
     * 要做修改,用定时任务查询,写入redis,然后api直接查询redis
     * @return [type] [description]
     */
    public function hot()
    {
        // $limit = isset($this->params['num']) ? $this->params['num'] : 10;
        // if (!is_numeric($limit)) {
        //     return $this->writeJson(Status::CODE_BAD_REQUEST, [], '非法参数');
        // }
        // $model = new Video();
        // $list  = $model->getHot($limit, 'id,title,img');
        // if (empty($list)) {
        //     return $this->writeJson(Status::CODE_BAD_REQUEST, [], '没有找到相关数据');
        // }
        $data = [
            ['title' => '三生三世', 'img' => 'images/2.jpg', 'id' => 1, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世a', 'img' => 'images/3.jpg', 'id' => 2, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世d', 'img' => 'images/4.jpg', 'id' => 3, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世f', 'img' => 'images/5.jpg', 'id' => 4, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世g', 'img' => 'images/6.jpg', 'id' => 5, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世g', 'img' => 'images/7.jpg', 'id' => 5, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世g', 'img' => 'images/8.jpg', 'id' => 5, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
            ['title' => '三生三世g', 'img' => 'images/9.jpg', 'id' => 5, 'source' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556600533&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=DEfhMQ3ZiwbzUsy5xgUlwcwMzUg%3D'],
        ];
        return $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}
