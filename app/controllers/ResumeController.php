<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/19
 * Time: 19:34
 */
class ResumeController extends BaseController
{
    public function getIndex(){
//        return View::make('resume.index');
        $this->layout->nest('content',$this->viewPrefix . 'resume.index',array());
    }

    public function getContent(){
        return View::make('resume.content');
    }
}