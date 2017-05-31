<?php
use Illuminate\Support\Facades\Response;

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/8/31
 * Time: 22:12
 */
class JsonController extends BaseController
{

    /**
     * JsonController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        //header('Access-Control-Allow-Origin *');
        //header('Access-Control-Allow-Headers X-Requested-With');
        //header('Access-Control-Allow-Methods GET,POST,OPTIONS');
    }

    public function getSimple(){
        $respData = array(
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  array(
                'rows'  =>  array(
                    array('name' => 'lvyahui','age' => 22),
                    array('name' => 'mm','age' => 22),
                ),
                'total' =>  100,
                'page'  =>  1,
            )
        );
        return Response::json($respData);
    }

    public function  postPush(){
        return $this->getSimple();
    }
}