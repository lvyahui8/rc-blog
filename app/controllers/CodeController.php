<?php
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-1-31
 * Time: 15:20
 */
class CodeController extends BaseController
{
    public function getIndex()
    {
        if(Session::get('isMobile')){
            $this->makeView();
        }else{
            return parent::getIndex();
        }
    }


    protected function beforeList(&$data)
    {
        $data['hotCodes'] = Code::whereNotNull('id')->orderBy("view_ct","desc")->limit(10)->get();
    }

    protected function beforeView(&$data)
    {
        $code = $data['model'];
        $code->view_ct += 1;
        $code->save();
        $data['prevCode'] = Code::orderBy('created_at','desc')->where('created_at','<',$code->created_at)->first();
        $data['nextCode'] = Code::orderBy('created_at')->where('created_at','>',$code->created_at)->first();
    }
}