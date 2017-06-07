<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/15
 * Time: 22:11
 */
class AboutController extends BaseController
{
    public function getTimeline(){
        $this->makeView();
    }

    public function getIndex(){
        $this->title = '关于博客作者';
        $this->makeView();
    }

    public function getMe(){
        $this->makeView();
    }
}