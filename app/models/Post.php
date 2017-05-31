<?php

/**
 * User: lvyahui
 * Date: 2016/1/22
 * Time: 23:05
 */
class Post extends BaseModel
{
    protected $table = 'post';
    public $timestamps = true;

    public function category(){
        return $this->belongsTo('Category','category_id');
    }

    public function comments(){
        return $this->hasMany('Comment','proj_id');
    }

    public function tags(){
        return $this->belongsToMany('Tag','post_tag','post_id','tag_id');
    }

    public static function filters(){
        return array(
            'category_id'   =>  array(),
            'title' =>  array(),
            'short' =>  array(),
            'view_ct'   =>  array(
                'operator'  =>  '>'
            )
        );
    }

    public function getUpdatedAtAttribute(){
        return 'xxxx';
    }

}