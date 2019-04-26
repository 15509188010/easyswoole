<?php

namespace App\Model;

/**
 *  admin数据模型
 */
class Admin extends Model
{
    public function getList()
    {
        return $this->select();
    }
}
