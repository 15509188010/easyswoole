<?php

namespace App\HttpController\Api;

use App\Lib\ClassArr;
use App\Model\Video;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

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

    /**
     * 数据入库
     * @return [type] [description]
     */
    public function write()
    {
        $data = $this->request()->getRequestParam();
        if (empty($data)) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], "非法数据");
        }
        $validate = new Validate();
        $validate->addColumn('title')->required('标题必填');
        $validate->addColumn('cid')->required('分类必填');
        $validate->addColumn('url')->required('视频图片必须上传');
        $validate->addColumn('aid')->required('视频必须上传');
        $validate->addColumn('weigh')->required('权重非法')->between(10, 100, '权重只能在10-100间');
        $validate->addColumn('content')->required('视频简介必填');
        $insert = [
            'title'   => $data['title'],
            'aid'     => $data['aid'],
            'cid'     => $data['cid'],
            'img'     => $data['url'],
            'status'  => $data['status'] == 'on' ? 0 : 1,
            'content' => $data['content'],
            'weigh'   => $data['weigh'],
            'ctime'   => time(),
        ];
        $res = (new Video())->addVideo($insert);
        if (!$res) {
            return $this->writeJson(Status::CODE_BAD_REQUEST, [], "提交失败");
        }
        return $this->writeJson(Status::CODE_OK, [], "OK");
    }
}
