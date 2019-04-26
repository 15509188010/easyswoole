<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;

/**
 * 控制器基类
 */
class Base extends Controller
{

    public function index()
    {

    }

    /**
     * onRequest返回false的时候，为拦截请求，不再往下执行方法
     * 此方法为重写父类中的方法
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    protected function onRequest($action):  ? bool
    {
        return true;
    }

    /**
     * 异常抛出
     * @param  \Throwable $throwable [description]
     * @return [type]                [description]
     */
    // protected function onException(\Throwable $throwable) : void
    // {
    //     $this->writeJson(Status::CODE_BAD_REQUEST, [], '非法请求');
    // }

}
