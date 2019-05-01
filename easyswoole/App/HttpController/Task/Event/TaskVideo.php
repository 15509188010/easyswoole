<?php

namespace App\HttpController\Task\Event;

use App\Model\Video;
use EasySwoole\Component\Di;
use EasySwoole\EasySwoole\Logger;

/**
 * 定时任务的逻辑
 */
class TaskVideo
{
    public static function getHotList($taskId)
    {
        $model = new Video();
        $list  = $model->getHot(8, 'id,aid,title,cid,img,content,click,zan,fav');
        if (empty($list)) {
            Logger::getInstance()->log('getHotList-' . $taskId . ':没有相关数据!');
        }
        $res = Di::getInstance()->get('REDIS')
            ->set(\Yaconf::get('redis.video_key'), json_encode($list, 320));
    }
}
