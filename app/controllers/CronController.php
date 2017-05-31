<?php

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/31
 * Time: 22:16
 */
class CronController extends BaseController
{
    public function getCategory(){
        $categorys = Category::all();
        foreach($categorys as $category){
            $category->post_ct = Post::where('category_id',$category->id)->count();
            echo "$category->title:$category->post_ct\n";
            $category->save();
        }
        exit;
    }
}