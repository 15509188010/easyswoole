<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 19-05-01
 * Time: 下午3:30
 */

namespace App\HttpController\Task;

use App\HttpController\Task\Event\TaskVideo;
use EasySwoole\EasySwoole\Crontab\AbstractCronTask;

class TaskHot extends AbstractCronTask
{

    public static function getRule(): string
    {
        // TODO: Implement getRule() method.
        // 定时周期 （每2分钟）
        return '*/20 * * * *';
    }

    public static function getTaskName(): string
    {
        // TODO: Implement getTaskName() method.
        // 定时任务名称
        return 'taskHot';
    }

    public static function run(\swoole_server $server, int $taskId, int $fromWorkerId, $flags = null)
    {
        // TODO: Implement run() method.
        // 定时任务处理逻辑
        TaskVideo::getHotList($taskId);
    }
}
