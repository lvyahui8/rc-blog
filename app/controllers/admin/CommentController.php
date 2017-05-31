<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/3/1
 * Time: 19:42
 */

namespace admin;


class CommentController extends AdminController
{
    protected function config()
    {
        return array(
            'list'  =>  array(
                'id'    =>  true,
                'proj_id'   =>  array(
                    'alias'=>'项目ID'
                ),
                'user_id'   =>  array(

                ),
                'proj_type' =>  array(
                    'alias' =>  '项目类型',
                    'type'  =>  'translate',
                    'translate' =>  function($value){
                        $map = array('post'=>'博客','code'=>'微码','site'=>'整站');
                        return $map[$value];
                    }
                ),
                'content'   =>  array(
                    'alias' =>  '内容'
                )
            ),
            'listOption'    =>  array(
                'create'    =>  false,
                'update'    =>  false,
                'delete'    =>  true,
            )
        );
    }

}