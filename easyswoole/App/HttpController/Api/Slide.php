<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\Component\Di;
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
        $data = Di::getInstance()->get('REDIS')->get(\Yaconf::get('redis.video_key'));
        if (empty($data)) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], 'error');
        } else {
            $data = json_decode($data, true);
        }
        return $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}
