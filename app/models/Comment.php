<?php

/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/2/27
 * Time: 20:12
 */
class Comment extends BaseModel
{
    protected $table = 'comments';
    public $timestamps = true;
    public $orderBy = array(
        'field' =>  'created_at',
        'order'   => 'desc',
    );
    public static function filters(){
        return array(
            'proj_id'   =>  array(),
            'proj_type' =>  array(),
        );
    }

    public function user(){
        return $this->belongsTo('User','user_id');
    }

    public function getUrlAttribute(){
        if($this->proj_type === 'post'){
            return URL::to('blog/view/'.$this->proj_id);
        } else if($this->proj_type=== 'code'){
            return URL::to('code/view/'.$this->proj_id);
        }
        else{
            return URL::to('about');
        }
    }
}