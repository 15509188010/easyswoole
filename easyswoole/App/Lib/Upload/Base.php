<?php
namespace App\Lib\Upload;

use App\Lib\AliyunSdk\AliVod;
use App\Lib\Utils;

/**
 *
 */
class Base
{
    /**
     * 上传文件 file -key
     * @var string
     */
    public $type = "";

    /**
     * [__construct description]
     * @param [type] $request [description]
     * @param [type] $type    [description]
     */
    public function __construct($request, $type = null)
    {
        $this->request = $request;
        if (empty($type)) {
            $files      = $this->request->getSwooleRequest()->files;
            $types      = array_keys($files);
            $this->type = $types[0];
        } else {
            $this->type = $type;
        }
    }

    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload()
    {
        if ($this->type != $this->fileType) {
            return false;
        }
        $videos     = $this->request->getUploadedFile('file');
        $this->size = $videos->getSize();
        $this->checkSize();
        $fileName              = $videos->getClientFileName();
        $this->clientMediaType = $videos->getClientMediaType();
        $this->checkClientMediaType();
        $file = $this->getFile($fileName);
        if ($this->type == 'video') {
            $flag = $this->videoUpload($videos);
            return $flag;
        } else {
            $flag = $videos->moveTo($file);
        }
        if (!empty($flag)) {
            return $this->file;
        }
        return false;
    }

    /**
     * [getFile description]
     * @param  [type] $fileName [description]
     * @return [type]           [description]
     */
    public function getFile($fileName)
    {
        $pathinfo  = pathinfo($fileName);
        $extension = $pathinfo['extension'];

        $dirname = "/" . $this->type . "/" . date("Y") . "/" . date("m");
        $dir     = EASYSWOOLE_ROOT . "/webroot" . $dirname;
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $basename   = "/" . Utils::getFileKey($fileName) . "." . $extension;
        $this->file = $dirname . $basename;
        return $dir . $basename;
    }

    /**
     * 检测上传文件类型
     * @return [type] [description]
     */
    public function checkClientMediaType()
    {
        $clientMediaType = explode("/", $this->clientMediaType);
        $clientMediaType = isset($clientMediaType[1]) ? $clientMediaType[1] : "";
        if (empty($clientMediaType)) {
            throw new \Exception('上传' . $this->type . '文件不合法');
        }

        if (!in_array($clientMediaType, $this->fileExtTypes)) {
            throw new \Exception('上传' . $this->type . '文件不合法');
        }

        return true;
    }

    /**
     * [checkSize description]
     * @return [type] [description]
     */
    public function checkSize()
    {
        if (empty($this->size)) {
            return false;
        }
    }

    public function videoUpload($videos)
    {
        try {
            $files     = $this->request->getSwooleRequest()->files;
            $types     = $files['file'];
            $videoFile = $types['tmp_name'];
            if (empty($videoFile)) {
                throw new \Exception('上传' . $this->type . '文件失败');
            }
            $obj           = new AliVod();
            $title         = $videos->getClientFileName();
            $videoFileName = $videos->getClientFileName();
            $res           = $obj->createUploadVideo($title, $videoFileName, $other = []);
            if (empty($res)) {
                throw new \Exception('获取' . $this->type . '凭证失败');
            }
            $videoId       = $res->VideoId;
            $uploadAddress = json_decode(base64_decode($res->UploadAddress), true);
            $uploadAuth    = json_decode(base64_decode($res->UploadAuth), true);
            $obj->initOssClient($uploadAuth, $uploadAddress);
            $videoFile = "/www/wwwroot/easyswoole/webroot/videos/ming.mp4"; #本地的视频文件
            $result    = $obj->uploadLocalFile($uploadAddress, $videoFile);
            return $videoId;
        } catch (\Exception $e) {
            throw new \Exception('上传' . $this->type . '文件出错');
        }
    }
}
