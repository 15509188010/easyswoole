<?php

namespace App\Lib\Redis;

use EasySwoole\Component\Singleton;

/**
 *
 */
class Redis
{
    use Singleton; #实现单例

    public $redis = "";

    /**
     * 连接redis
     */
    private function __construct()
    {
        if (!extension_loaded('redis')) {
            throw new \Exception('redis拓展未开启');
        }
        try {
            //$redisConfig = Config::getInstance()->getConf('redis');#传统获取配置方式
            $redisConfig = \Yaconf::get('redis'); #通过yaconf拓展读取配置文件,性能高
            $this->redis = new \Redis();
            $result      = $this->redis->connect($redisConfig['host'], $redisConfig['port'], $redisConfig['time_out']);
        } catch (\Exception $e) {
            //throw new \Exception($e->getMessage());
            throw new \Exception('redis服务异常');
        }

        if ($result === false) {
            throw new \Exception('redis连接失败');
        }
    }

    /**
     * [__call description]set,setex,get,sAdd,sRem,sMembers,lPop,rPush
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     * @return [type]         [description]
     */
    public function __call($method, $args)
    {
        try {
            if (!empty($args)) {
                $num = count($args);
                switch ($num) {
                    case 1:
                        return $this->redis->$method($args[0]);
                        break;
                    case 2:
                        return $this->redis->$method($args[0], $args[1]);
                        break;
                    case 3:
                        return $this->redis->$method($args[0], $args[1], $args[2]);
                        break;
                    default:
                        //todo
                        break;
                }
            } else {
                return '';
            }
        } catch (\Exception $e) {
            throw new \Exception('Redis中没有' . $method . '方法');
        }
    }
}
