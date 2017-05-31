<?php

/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/2/2
 * Time: 13:57
 */
class Tag extends BaseModel
{
    protected $table = 'tag';

    public function posts(){
        return $this->belongsToMany('Post','post_tag','tag_id','post_id');
    }

    public function codes(){
        return $this->belongsToMany('Code','code_tag','tag_id','code_id');
    }
}