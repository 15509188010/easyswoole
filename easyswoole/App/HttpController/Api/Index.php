<?php

namespace App\HttpController\Api;

use App\HttpController\Base;
use App\Lib\AliyunSdk\AliVod;

/**
 *
 */
class Index extends Base
{
    public function testali()
    {
        $obj           = new AliVod();
        $title         = "ming_test";
        $videoFileName = "1.mp4";
        $res           = $obj->createUploadVideo($title, $videoFileName, $other = []);
        $uploadAddress = json_decode(base64_decode($res->UploadAddress), true);
        $uploadAuth    = json_decode(base64_decode($res->UploadAuth), true);
        $obj->initOssClient($uploadAuth, $uploadAddress);
        $videoFile = "/www/wwwroot/easyswoole/webroot/videos/ming.mp4"; #本地的视频文件
        $obj->uploadLocalFile($uploadAddress, $videoFile);
    }

    public function getVideo()
    {
        $id  = 'c4702e21347e4d5386aa853cbe70f23e';
        $obj = new AliVod();
        $res = $obj->getPlayInfo($id);
        print_r($res);
    }
}
