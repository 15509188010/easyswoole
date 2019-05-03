<?php

namespace App\HttpController\Api;

use App\Lib\ClassArr;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;

/**
 *
 */
class Upload extends Controller
{

    public function index()
    {

    }

    /**
     * 文件上传
     * @return [type] [description]
     */
    public function file()
    {
        $request = $this->request();
        $files   = $request->getSwooleRequest()->files;
        $types   = $files['file'];
        $type    = explode("/", $types['type'])[0];
        if (empty($type)) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], '上传文件不合法');
        }
        try {
            $classObj   = new ClassArr();
            $classStats = $classObj->uploadClassStat();

            $uploadObj = $classObj->initClass($type, $classStats, [$request, $type]);
            $file      = $uploadObj->upload();
        } catch (\Exception $e) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], $e->getMessage());
        }
        if (empty($file)) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], "上传失败");
        }
        $data = [
            'url' => $file,
        ];
        return $this->writeJson(Status::CODE_OK, $data, "OK");

    }
}
