<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/7
 * Time: 23:20
 */

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class DemoController extends BaseController
{
    public function getIndex(){
        $this->title = '示例程序';
        $this->makeView();
    }
    public function getHacker($slug = false){
        $this->title = '黑客帝国刷屏js-示例程序';
        $this->registStyle('js/syntaxhighlighter/styles/shCoreRDark.css');
        $this->registScript('js/syntaxhighlighter/scripts/shCore.js');
        $this->registScript('js/syntaxhighlighter/scripts/shAutoloader.js');
        $this->makeView(array('slug'=>$slug));
    }

    public function getDataTable(){
        $this->title = '行内编辑js插件（Excel）-示例程序';
        $this->makeView();
    }

    public function getJson(){
        $respData = array(
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  array(
                'users' =>  array(
                    array('name'=>'lvyahui','age'=>21),
                    array('name'=>'dengmo','age'=>20),
                )
            )
        );
        $respData['data'] = array_merge($respData['data'],
            array('params'=>Input::all()));
        return Response::json($respData);
    }

    public function postUploadImage(){
        $rawImage = urldecode(Input::get('pic'));
        $image = base64_decode(substr(strstr($rawImage,','),1));
        $name = md5(Input::get('username')).'.jpg';
        $file = base_path('uploads/images/').$name;
        file_put_contents($file,$image);
        return Response::json(array(
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  array(
                'url'   =>  URL::to('uploads/images/'.$name),
            )
        ));
    }

    public function getX5test(){
        $this->layout = View::make('layouts.mobile.main');

        $this->layout->nest('content','mobile.demo.x5test',array());
    }
    public function getCors(){
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Headers:*');
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:*');
        list($s1, $s2) = explode(' ', microtime());
        $msec= (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);

        return Response::json(array(
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  array(
                'time'  =>  $msec,
                'items' =>  array(
                    array('name'=>'lvyahui','age'=>23),
                    array('name'=>'xxxx','age'=>20),
                )
            )
        ));
    }
}