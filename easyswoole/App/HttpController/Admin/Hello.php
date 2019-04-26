<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin;
use EasySwoole\Component\Di;
use EasySwoole\Http\Message\Status;

/**
 *
 */
class Hello extends Base
{
    public function article()
    {
        $obj = new Admin();
        var_dump($obj->getList());
    }

    public function test()
    {
        // $res = Redis::getInstance()->get('ming');
        // return $this->writeJson(Status::CODE_OK, $res, 'ok');
        //容器使用
        $res = Di::getInstance()->get('REDIS')->get('ming');
        return $this->writeJson(Status::CODE_OK, $res, 'ok');
    }

    public function setRedis()
    {
        $res = Di::getInstance()->get('REDIS')->rPush('imooc_list_test', rand(1111, 99999));
        return $this->writeJson(Status::CODE_OK, $res, 'ok');
    }
}
