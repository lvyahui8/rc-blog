<?php
/**
 * User: lvyahui
 * Date: 2016/1/23
 * Time: 22:51
 */

namespace admin;


class CategoryController extends AdminController
{
    public function postEdit($id = null)
    {

    }

    public function config(){
        return array(
            'items' =>  array(
                'name'  =>  array(
                    'label'=>'',
                    'rule'=>'required',
                    'placeholder'=>'',
                )
            ),
        );
    }
}