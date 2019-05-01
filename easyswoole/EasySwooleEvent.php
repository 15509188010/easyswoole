<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;

use App\HttpController\Task\TaskHot;
use App\Lib\Redis\Redis;
use App\Pool\MysqlPool;
use EasySwoole\Component\Di;
use EasySwoole\Component\Pool\PoolManager;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\EasySwoole\Config;
use EasySwoole\EasySwoole\Crontab\Crontab;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Utility\File;

class EasySwooleEvent implements Event
{

    /**
     * 初始化
     * @return [type] [description]
     */
    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');

        /******************************连接池*******************************/
        $mysqlConf = PoolManager::getInstance()->register(MysqlPool::class, Config::getInstance()->getConf('MYSQL.POOL_MAX_NUM'));
        if ($mysqlConf === null) {
            //当返回null时,代表注册失败,无法进行再次的配置修改
            //注册失败不一定要抛出异常,因为内部实现了自动注册,不需要注册也能使用
            throw new \Exception('注册失败!');
        }
        self::loadConf(EASYSWOOLE_ROOT . '/Config'); #加载配置文件
    }

    /**
     * 注册事件
     * @param  EventRegister $register [description]
     * @return [type]                  [description]
     */
    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
        ################### mysql 热启动   #######################
        $register->add($register::onWorkerStart, function (\swoole_server $server, int $workerId) {
            if ($server->taskworker == false) {
                //每个worker进程都预创建连接
                PoolManager::getInstance()->getPool(MysqlPool::class)->preLoad(5); //最小创建数量
            }
        });

        /******************************注入redis*******************************/
        Di::getInstance()->set('REDIS', Redis::getInstance());

        /******************************注册3个进程(消费者模式)*******************************/
        // $allNum = 3;
        // for ($i = 0; $i < $allNum; $i++) {
        //     ServerManager::getInstance()->getSwooleServer()->addProcess((new ConsumerTest("consumer_{$i}"))->getProcess());
        // }

        /****************** Crontab任务计划 ***********************/
        Crontab::getInstance()->addTask(TaskHot::class);

    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }

    /**
     * 加载配置文件
     * @param  [type] $ConfPath [description]
     * @return [type]           [description]
     */
    public static function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDirectory($ConfPath);
        foreach ($files as $file) {
            if (is_array($file)) {
                foreach ($file as $name) {
                    $data = require_once $name;
                    $Conf->setConf(strtolower(basename($name, '.php')), (array) $data);
                }
            } else {
                $data = require_once $file;
                $Conf->setConf(strtolower(basename($file, '.php')), (array) $data);
            }
        }
    }
}
