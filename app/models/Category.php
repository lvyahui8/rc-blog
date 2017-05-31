<?php

/**
 * User: lvyahui
 * Date: 2016/1/22
 * Time: 21:58
 */
class Category extends BaseModel
{
    protected $table = 'category';
    public function posts(){
        return $this->hasMany('Post','category_id');
    }
}