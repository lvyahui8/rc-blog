<?php
use DiDom\Document;

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2017/6/17
 * Time: 10:31
 */
class TestCmd  extends \Illuminate\Console\Command
{
    protected $name = 'test_cmd';

    protected $description = 'Command description.';

    public function fire()
    {
        echo Post::max('cnblogs_id');
    }
}