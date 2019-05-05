<?php

namespace App\Lib\Cache;

use App\Model\Video as VideoModel;
use EasySwoole\Component\Di;

/**
 * video缓存
 * date:2019-05-05
 * author:ming
 */
class Video
{
    public function setNewVideo()
    {
        $cacheType = \Yaconf::get("base.indexCacheType");
        $key       = \Yaconf::get("base.newListKey");
        $model     = new VideoModel();
        try {
            $data = $model->getHot(5, 'id,title,ctime', 'ctime DESC');
        } catch (\Exception $e) {
            //可以发送邮件至邮箱,提醒开发者出现问题
            $data = [];
        }

        //时间转化
        foreach ($data as &$list) {
            $list['ctime'] = date("Ymd H:i:s", $list['ctime']);
            // 00:01:07
            //$list['video_duration'] = gmstrftime("%H:%M:%S", $list['video_duration']);
        }

        switch ($cacheType) {
            case 'file':
                $res = file_put_contents($this->getVideoCatIdFile($key), json_encode($data));
                break;
            case 'redis':
                $res = Di::getInstance()->get("REDIS")->set($this->getCatKey($key), $data);
                break;
            default:
                throw new \Exception("请求不合法");
                break;
        }

        if (empty($res)) {
            // 记录日志  报警
        }

    }

    public function getCache($key = 0)
    {
        $cacheType = \Yaconf::get("base.indexCacheType");
        switch ($cacheType) {
            case 'file':
                $videoFile = $this->getVideoCatIdFile($key);
                $videoData = is_file($videoFile) ? file_get_contents($videoFile) : [];
                $videoData = !empty($videoData) ? json_decode($videoData, true) : [];
                break;
            case 'redis':
                $videoData = Di::getInstance()->get("REDIS")->get($key);
                $videoData = !empty($videoData) ? json_decode($videoData, true) : [];
                break;
            default:
                throw new \Exception("请求不合法");
                break;
        }

        return $videoData;
    }

    /**
     * [getVideoCatIdFile description]
     * @auth   singwa
     * @param  integer $catId [description]
     * @return [type]         [description]
     */
    public function getVideoCatIdFile($key = 0)
    {
        $dir = EASYSWOOLE_ROOT . "/webroot/video/json/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return EASYSWOOLE_ROOT . "/webroot/video/json/" . $key . ".json";
    }
}
