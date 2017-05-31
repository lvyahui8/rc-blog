<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/2/2
 * Time: 13:55
 */
class Code extends BaseModel{
    protected $table = 'code';
    public $timestamps = true;
    public function tags(){
        return $this->hasMany('tag','code_tag','code_id','tag_id');
    }
}