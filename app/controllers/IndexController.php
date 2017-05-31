<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-1-31
 * Time: 20:17
 */
class IndexController extends BaseController
{
    protected $layout = 'layouts.frame';
    public function getIndex(){

        $newPosts = Post::orderBy('created_at','desc')->limit(10)->get();
        $this->layout->nest('content',$this->viewPrefix . 'index.index',array('newPosts'=>$newPosts))->with('newPosts',$newPosts);
    }
}