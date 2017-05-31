<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/6/24
 * Time: 17:37
 */

namespace admin;


class UserController extends AdminController
{
    protected function config()
    {
        return array(
            'list'  =>  array(
                'id'    =>  true,
                'username' =>  array(
                    'alias' =>  '用户名'
                ),
                'salt'  =>  array(
                    'alias' =>  '盐',
                ),
                'email' =>  array(
                    'alias' =>  '邮箱'
                ),
                'avatar'    =>  array(

                ),
                'openid'    =>  array(

                )
            ),
            'items' =>  array(
                'username' =>  array(
                    'alias' =>  '用户名'
                ),
                'salt'  =>  array(
                    'alias' =>  '盐',
                ),
                'email' =>  array(
                    'alias' =>  '邮箱'
                ),
                'avatar'    =>  array(

                ),
                'openid'    =>  array(

                )
            )
        );
    }

}