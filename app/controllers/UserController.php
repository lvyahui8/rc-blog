<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/6 0006
 * Time: 16:57
 */
class UserController extends BaseController
{
    public function getInfo(){
        return $this->makeView();
    }
}