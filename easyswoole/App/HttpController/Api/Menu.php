<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use App\Model\Category;
use EasySwoole\Component\Di;
use EasySwoole\Http\Message\Status;

/**
 * date:2019-04-28
 * author:ming
 * menu模块
 */
class Menu extends Base
{
    public function category()
    {

        $info = Di::getInstance()->get('REDIS')->get(\Yaconf::get('redis.category_key'));
        if ($info == false) {
            $model = new Category();
            $data  = [
                'one'   => $model->getAllCategory('id,title', 1),
                'two'   => $model->getAllCategory('id,title', 2),
                'three' => $model->getAllCategory('id,title', 3),
                'four'  => $model->getAllCategory('id,title', 4),
            ];
            Di::getInstance()->get('REDIS')
                ->setex(\Yaconf::get('redis.category_key'), \Yaconf::get('redis.category_out'), json_encode($data, 320));
        } else {
            $data = json_decode($info, true);
        }
        return $this->writeJson(Status::CODE_OK, $data, 'success');
    }
}
