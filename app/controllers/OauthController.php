<?php
/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/6/14
 * Time: 19:49
 */
require_once dirname(__FILE__).'/../library/qc/qqConnectAPI.php';
function mkdirs($dir)
{
    if(!is_dir($dir))
    {
        if(!mkdirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,0777)){
            return false;
        }
    }
    return true;
}
function download($url,$saveFile){
    $ctx = stream_context_create(array(
        'http' => array(
            'timeout' => 5,  // 5 s
        ),
    ));
    if (strpos($url, 'http://') === false) $url= 'http://' . $url;
    $fileContent = @file_get_contents($url, false, $ctx);
    if($fileContent){
        file_force_contents($saveFile,$fileContent);
        return true;
    }else{
        return false;
    }
}
function file_force_contents($full_name, $contents){
    $i = strrpos($full_name,'/');
    $paths = substr($full_name,0,$i);
    mkdirs($paths);
    $file = substr($full_name,$i + 1);
    file_put_contents("$paths/$file", $contents);
}
class OauthController extends BaseController
{

    public function getQcLogin(){
        $qc = new QC();
        $qc->qq_login();
        exit;
    }

    public function getQcLoginCallback(){
        $qc = new QC();
        $token =  $qc->qq_callback();
        $openid =  $qc->get_openid();
        $resp = null;
        if($openid) {
            $user = User::where('oauth_type','qq')->where('openid',$openid)->first();
            if(!$user){
                //print_r('create user');exit;
                // 注册一个用户
                $qc = new QC($token,$openid);
                $userInfo = $qc->get_user_info();

                $user = new User();
                $user->oauth_type = 'qq';
                $user->openid = $openid;

                $user->username = $userInfo['nickname'];
                $user->salt = str_random(4);
                $user->password = SiteHelpers::makePass('123456',$user->salt);
                // 获取头像
                $src = $userInfo['figureurl_qq_2'] ? $userInfo['figureurl_qq_2'] : $userInfo['figureurl_qq_1'];
                $fileName = md5($openid).'.jpg';
                download($src,base_path().'/uploads/images/'.$fileName);
                $user->avatar = $fileName;
                $user->save();
//                print_r('savesuccess');exit;
            }
            Auth::login($user);
//            $resp = Redirect::to('');
            $statusCode = 200;
            $content = '<script>window.parent.$baseModal.data("login",1).modal("hide");</script>';
            $resp = Response::make($content, $statusCode);
        }

        return $resp;
    }
}