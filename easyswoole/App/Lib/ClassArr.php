<?php

namespace App\Lib;

/**
 * PHP反射机制
 */
class ClassArr
{

    /**
     *
     * @return [type] [description]
     */
    public function uploadClassStat()
    {
        return [
            'image' => "\App\Lib\Upload\Image",
            'video' => "\App\Lib\Upload\Video",
        ];
    }

    /**
     * [initClass description]
     * @param  [type]  $type           [description]
     * @param  [type]  $supportedClass [description]
     * @param  array   $params         [description]
     * @param  boolean $needInstance   [description]
     * @return [type]                  [description]
     */
    public function initClass($type, $supportedClass, $params = [], $needInstance = true)
    {
        if (!array_key_exists($type, $supportedClass)) {
            return false;
        }

        $className = $supportedClass[$type];

        return $needInstance ? (new \ReflectionClass($className))->newInstanceArgs($params) : $className;
    }
}
