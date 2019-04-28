<?php

namespace App\HttpController\Api;

use App\HttpController\Base;

/**
 *
 */
class Video extends Base
{
    function list() {
        $data = [
            ['title' => '三生三世'],
            ['title' => '致青春'],
            ['title' => '倚天屠龙记'],
            ['title' => '笑傲江湖'],
        ];
        return $this->writeJson(200, 'success', $data);
    }

    public function category()
    {
        $data = [
            'one'   => [
                ['title' => '三生三世'],
                ['title' => '致青春'],
                ['title' => '倚天屠龙记'],
                ['title' => '笑傲江湖'],
            ],
            'two'   => [
                ['title' => '三生三世t'],
                ['title' => '致青春t'],
                ['title' => '倚天屠龙记t'],
                ['title' => '笑傲江湖t'],
            ],
            'three' => [
                ['title' => '三生三世t'],
                ['title' => '致青春t'],
                ['title' => '倚天屠龙记t'],
                ['title' => '笑傲江湖t'],
            ],
            'four'  => [
                ['title' => '三生三世f'],
                ['title' => '致青春f'],
                ['title' => '倚天屠龙记f'],
                ['title' => '笑傲江湖f'],
            ],
        ];

        return $this->writeJson(200, 'success', $data);
    }
}
