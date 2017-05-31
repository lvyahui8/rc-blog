<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class TestController extends BaseController
{

    protected $layout = 'layouts.site';

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function postTableRow()
    {
        $data = Input::all();
        $data['id'] = rand(1, 1000);
        return Response::json($data);
    }

    public function getTableDelete()
    {
        return Response::json(Input::get('id'));
    }

    public function getIndex()
    {
        $this->makeView();
    }

    public function getFscroll()
    {
        return View::make('test.fscroll');
    }

    public function getSubpage()
    {
        return View::make('test.subpage');
    }

    public function getDevlop()
    {
        $this->makeView();
    }

    public function getSource()
    {
        $this->makeView();
    }

    public function postLs()
    {
        clearstatcache();
        $path = Input::get('path');
        $fileNames = scandir($path, 0);
        $files = [];
        foreach ($fileNames as $fileName) {
            if ($fileName === '.' || $fileName === '..') continue;
            $files[] = array(
                'name'     => basename($fileName),
                'path'     => $path . '/' . $fileName,
                'isParent' => is_dir($fileName),
            );
        }
        return Response::json($files);
    }


    public function getAttr()
    {
        $posts = Post::whereNotNull('id')->limit(3)->get();
        foreach ($posts as $post) {
            print_r($post->updated_at);
            echo "<br>";
        }
        exit;
    }

    public function getLogin()
    {
        echo '<pre>';
        print_r(Auth::user());
        exit;
    }

    public function getCreatePost()
    {
        $post = Post::create(array(
            'cnblogs_url' => 'http://www.cnblogs.com/lvyahui/p/4695627.html',
            'cnblogs_id'  => 4695627,
            'title'       => '或许有一两点你不知的C语言特性',
            'content'     => 'xxxxxxxxxxxxxxxxxxxxxxxx',
            'short'       => 'xxxxxxxxxxxxxxxxxxxxxxxx',
            'view_ct'     => 1332,
            'created_at'  => '2015-08-02 13:58:00',
            'category_id' => 4,
        ));
        print_r($post);
    }

    public function getSession(){
        echo '<pre>';
        print_r(Session::all());
        echo '</pre>';
        exit;
    }
}