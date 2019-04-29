<?php

namespace App\HttpController\Api;

use App\Model\Appkey;
use EasySwoole\Component\Di;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;

/**
 * 控制器基类
 */
class Base extends Controller
{
    /**
     * 参数
     * @var [type]
     */
    public $params;

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
        $this->params = $this->request()->getRequestParam();
        $data         = $this->params;
        if (!isset($data['appKey'])) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], 'appKey不能为空');
            return false;
        }

        if (!isset($data['sign'])) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], 'sign不能为空');
            return false;
        }
        $store = Di::getInstance()->get('REDIS')->get($data['appKey']);
        if ($store == false) {
            $model = new Appkey();
            $store = $model->getAppkey($data['appKey'], 'appkey,appsecret,uid');
            if (empty($store)) {
                $this->writeJson(Status::CODE_BAD_REQUEST, [], 'appKey信息不合法');
                return false;
            }
            /***redis中没有,把数据库中查的数据写入redis****/
            Di::getInstance()->get('REDIS')
                ->setex($data['appKey'], \Yaconf::get('redis.store_out'), json_encode($store));
        } else {
            $store = json_decode($store, true);
        }

        $serverSign = $this->makeSign($data, $store['appsecret']);

        if ($serverSign != $data['sign']) {
            $this->writeJson(Status::CODE_BAD_REQUEST, [], 'sign信息不合法');
            return false;
        }
        return true;
    }

    /**
     * 异常抛出,有错误的时候不会暴露,会返回这个错误,线上开启
     * @param  \Throwable $throwable [description]
     * @return [type]                [description]
     */
    // protected function onException(\Throwable $throwable) : void
    // {
    //     $this->writeJson(Status::CODE_BAD_REQUEST, [], '非法请求');
    // }

    /**
     * 生成签名
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    protected function makeSign($data, $appsecret)
    {
        if (isset($data['sign'])) {
            unset($data['sign']);
        }
        ksort($data);
        $md5str = "";
        foreach ($data as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $str = $md5str . 'key=' . $appsecret;
        return md5($str);
    }
}
