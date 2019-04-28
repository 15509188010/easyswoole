<?php

namespace App\HttpController\Api;

use App\HttpController\Base;
use App\Model\Category;

/**
 * date:2019-04-28
 * author:ming
 * menu模块
 */
class Menu extends Base
{
    public function category()
    {
        $model = new Category();
        $list  = $model->getAllCategory('id,title');
        $data  = [
            'one' => $list,
        ];

        return $this->writeJson(200, $data, 'success');

    }
}
