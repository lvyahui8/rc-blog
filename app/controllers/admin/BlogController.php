<?php

/**
 * User: lvyahui
 * Date: 2016/1/22
 * Time: 23:15
 */

namespace admin;

use Illuminate\Auth;
use Illuminate\Support\Facades\View;
use \Post;
use \Category;
class BlogController extends AdminController
{
    protected $modelName = 'post';

    protected function beforeSave($model, $relations)
    {
        if(!$model->id){
            $category = Category::find($model->category_id);
            $category->post_ct += 1;
            $category->save();
        }
        return true;
    }

    protected function config()
    {
        return array(
            'items' =>  array(
                'category_id'   =>  array(
                    'label' =>  '栏目',
                    'type'  =>  'select',
                    'options'   =>  function(){
                        return Category::all()->lists('title','id');
                    }
                ),
                'title' =>  array(
                    'label' =>  '标题'
                ),
                'short' =>  array(
                    'label' =>  '摘要',
                    'type'  =>  'textarea',
                ),
                'content'   =>  array(
                    'label' =>  '正文',
                    'type'  =>  'wysiwyg',
                ),
            ),
            'list'  =>  array(
                'id'    =>  true,
                'title' =>  array(
                    'alias'  => '标题'
                ),
                'short' =>  array(
                    'alias' => '摘要'
                )
            ),
            'formOption'    =>  array(
                'cols'  =>  12,
                'labelCols' =>  1,
                'inputCols' =>  11,
            ),
            'listOption'    =>  array(
                'filters'   =>  \Post::filters()
            )
        );
    }

    protected function beforeDelete($id)
    {
        $category =  Post::with('category')->find($id)->category;
        if($category){
            $category->post_ct -= 1;
            $category->save();
        }
    }

}