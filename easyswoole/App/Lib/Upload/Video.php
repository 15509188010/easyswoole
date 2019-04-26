<?php

namespace App\Lib\Upload;

use App\Lib\Upload\Base;

/**
 *
 */
class Video extends Base
{
    /**
     * 文件类型
     * @var string
     */
    public $fileType = 'video';

    /**
     * 文件最大尺寸
     * @var integer
     */
    public $maxSize = 1240;

    /**
     * 文件后缀的mediaType
     * @var [type]
     */
    public $fileExtTypes = [
        'mp4',
        'x-flv',
    ];
}
