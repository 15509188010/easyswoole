<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use App\Lib\AliyunSdk\AliVod;
use App\Model\Video as VideoModel;
use EasySwoole\Http\Message\Status;

/**
 *
 */
class Video extends Base
{
    public function click()
    {
        if (!is_numeric($this->params['id'])) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], '参数非法');
        }
        $id   = $this->params['id'];
        $info = (new VideoModel())->getVideoInfo($id, 'aid,title,id');
        if (empty($info)) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], '信息获取失败');
        }
        try {
            $result = (new AliVod())->getPlayInfo($info['aid']);
            if (!is_object($result)) {
                return $this->writeJson(Status::CODE_BAD_REQUEST, [], '获取信息时出错');
            }
            $base    = $result->PlayInfoList->PlayInfo;
            $playUrl = $base[0]->PlayURL;
            $data    = [
                'title' => $info['title'],
                'url'   => $playUrl,
                'id'    => $info['id'],
            ];
            return $this->writeJson(Status::CODE_OK, $data, 'success');
        } catch (\Exception $e) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], $e->getMessage());
        }
    }
}
