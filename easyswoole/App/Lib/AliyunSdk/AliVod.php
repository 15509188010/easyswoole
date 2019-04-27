<?php

namespace App\Lib\AliyunSdk;

require_once EASYSWOOLE_ROOT . '/App/Lib/AliyunSdk/aliyun-php-sdk-core/Config.php';
//假定您的源码文件和aliyun-php-sdk处于同一目录。
require_once EASYSWOOLE_ROOT . '/App/Lib/AliyunSdk/aliyun-oss-php-sdk-master/autoload.php';

use OSS\OssClient;
use vod\Request\V20170321 as vod;

/**
 *
 */
class AliVod
{

    public $regionId = 'cn-shanghai'; #点播服务所在的Region，国内请填cn-shanghai，不要填写别的区域
    public $client;
    public $ossClient;
    public function __construct()
    {
        $profile      = \DefaultProfile::getProfile($this->regionId, \Yaconf::get('aliyun.accessKeyId'), \Yaconf::get('aliyun.accessKeySecret'));
        $this->client = new \DefaultAcsClient($profile);
    }

    /**
     * 上传信息
     * @param  [type] $title         [description]
     * @param  [type] $videoFileName [description]
     * @param  array  $other         [description]
     * @return [type]                [description]
     */
    public function createUploadVideo($title, $videoFileName, $other = [])
    {
        $request = new vod\CreateUploadVideoRequest();
        $request->setTitle($title); // 视频标题(必填参数)
        $request->setFileName($videoFileName); // 视频源文件名称，必须包含扩展名(必填参数)
        if (!empty($other['description'])) {
            $request->setDescription($other['description']); // 视频源文件描述(可选)
        }
        if (!empty($other['cover'])) {
            $request->setCoverURL($other['cover']); // 自定义视频封面(可选)
        }
        if (!empty($other['label'])) {
            $request->setTags($other['label']); // 视频标签，多个用逗号分隔(可选)
        }
        $result = $this->client->getAcsResponse($request);
        if (empty($result) || empty($result->VideoId)) {
            throw new \Exception('获取上传凭证不合法');
        }

        return $result;
    }

    /**
     * [initOssClient description]
     * @param  [type] $uploadAuth    [description]
     * @param  [type] $uploadAddress [description]
     * @return [type]                [description]
     */
    public function initOssClient($uploadAuth, $uploadAddress)
    {
        $this->ossClient = new OssClient($uploadAuth['AccessKeyId'], $uploadAuth['AccessKeySecret'], $uploadAddress['Endpoint'],
            false, $uploadAuth['SecurityToken']);
        $this->ossClient->setTimeout(\Yaconf::get('aliyun.timeout')); // 设置请求超时时间，单位秒，默认是5184000秒, 建议不要设置太小，如果上传文件很大，消耗的时间会比较长
        $this->ossClient->setConnectTimeout(\Yaconf::get('aliyun.clienttimeout')); // 设置连接超时时间，单位秒，默认是10秒
    }

    /**
     * [uploadLocalFile description]
     * @param  [type] $ossClient     [description]
     * @param  [type] $uploadAddress [description]
     * @param  [type] $localFile     [description]
     * @return [type]                [description]
     */
    public function uploadLocalFile($uploadAddress, $localFile)
    {
        return $this->ossClient->uploadFile($uploadAddress['Bucket'], $uploadAddress['FileName'], $localFile);
    }

    /**
     * [getPlayInfo description]
     * @param  integer $videoId [description]
     * @return [type]           [description]
     */
    public function getPlayInfo($videoId = 0)
    {
        if (empty($videoId)) {
            return [];
        }

        $request = new vod\GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormmat('JSON');

        return $this->client->getAcsResponse($request);
    }
}
