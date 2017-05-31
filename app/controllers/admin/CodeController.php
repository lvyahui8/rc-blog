<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/2/2
 * Time: 13:59
 */

namespace admin;

class CodeController extends AdminController
{
    protected function config()
    {
        return array(
            'list'  =>  array(
                'id'    =>  true,
                'title' =>  array(
                    'alias' =>  '标题'
                ),
                'lang'  =>  array(
                    'alias' =>  '语言',
                ),
                'short' =>  array(
                    'alias' =>  '简评'
                ),
            ),
            'items' =>  array(
                'title' =>  array(

                ),
                'body'  =>  array(
                    'type'  =>  'textarea'
                ),
                'lang'  =>  array(

                ),
                'short' =>  array(
                    'type'  =>  'textarea'
                )
            )
        );
    }
}