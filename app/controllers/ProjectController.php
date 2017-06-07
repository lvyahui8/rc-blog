<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-1-24
 * Time: 18:17
 */
class ProjectController extends BaseController
{
    public function getList()
    {
        $this->title = '曾经做过的项目';
        return parent::getList();
    }

}