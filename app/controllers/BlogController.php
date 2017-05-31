<?php
use Illuminate\Support\Facades\Session;

/**
 * User: lvyahui
 * Date: 2016/1/22
 * Time: 21:25
 */
class BlogController extends BaseController
{
    protected $modelName = 'post';

    protected function beforeList(&$data)
    {
        if(!Session::get('isMobile')){
            $data['categorys'] = Category::all();
            $data['hotPosts'] = Post::whereNotNull('id')->orderBy("view_ct","desc")->limit(10)->get();
        }
    }

    protected function beforeView(&$data)
    {
        $post = $data['model'];
        $post->view_ct += 1;
        $post->save();
        $data['prevPost'] = Post::orderBy('created_at','desc')->where('created_at','<',$post->created_at)->first();
        $data['nextPost'] = Post::orderBy('created_at')->where('created_at','>',$post->created_at)->first();
    }


}