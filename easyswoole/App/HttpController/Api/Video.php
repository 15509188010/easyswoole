<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\Http\Message\Status;

/**
 *
 */
class Video extends Base
{
    public function click()
    {
        $data = ['title' => 'video', 'url' => 'https://outin-1ed325a0682a11e9895600163e06123c.oss-cn-shanghai.aliyuncs.com/sv/2bf15241-16a5da704d3/2bf15241-16a5da704d3.mp4?Expires=1556603833&OSSAccessKeyId=LTAItL9Co9nUDU5r&Signature=U%2FyxuF%2F5mwP5tMiTdDrbxSLRUvw%3D'];

        return $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}
