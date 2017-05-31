<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class BaseController extends Controller
{

    protected $viewPrefix = '';

    protected $layout = 'layouts.site';

    protected $data = array();

    protected $model = null;

    protected $modelName = '';

    protected $stdName = null;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }


    public static function p($object){
        echo '<pre>';
        print_r($object);
        echo '</pre>';
    }

    public static function pe($object){
        self::p($object);exit;
    }

    public $modals = [];

    public function appendModal($modalType,$data){
        $this->modals[] = View::make('modal.'.$modalType,$data);
    }

    private $scripts  = array();
    private $styles = array();

    public function registScript($jsFile){
        array_push($this->scripts,HTML::script(asset($jsFile)));
    }

    public function registStyle($cssFile){
        $this->styles[] = HTML::style(asset($cssFile));
    }

    public function getScriptHtml(){
        return join('',$this->scripts);
    }

    public function getStyleHtml(){
        return implode('',$this->styles);
    }

    protected $savedConfig = array();

    protected $breadcrumbs = array();


    public function __construct()
    {
        View::share('ctrl',$this);
        if(!$this->modelName){
            $this->modelName = $this->getStdName();
        }
        if(class_exists(ucfirst($this->modelName))){
            $this->model = new $this->modelName;
        }

        if(!Session::has('isMobile')){
            Session::put('isMobile',SiteHelpers::checkIfMobile());
        }

        if(Session::get('isMobile')){
            $this->viewPrefix = 'mobile.';
            $this->layout = 'layouts.mobile.main';
        }
    }


    public function getStdName()
    {
        if(!$this->stdName){
            $className = get_class($this);
            if (preg_match('/([\w]+)Controller$/', $className, $matches))
            {
//                $this->stdName =  camel_case($matches[1]);
                $this->stdName = lcfirst($matches[1]);
            }
            else
            {
                $this->stdName = $className;
            }
        }
        return $this->stdName;
    }


    public function makeView($data = array(),$view = null){
        if(!$view){
            $controllerName = strtolower(str_replace("\\",".",$this->getStdName()));
            $methodName = $this->routeMethod();
            if(preg_match('/^get(.*)$/',$methodName,$matches)){
                $methodName = lcfirst($matches[1]);
            }
            $view = $controllerName.'.'.$methodName;
        }
        if(!is_array($data)){
            $data = array();
        }
        if(Request::ajax()){
            return View::make($this->viewPrefix . $view,$data);
        }else{
            $this->layout->nest('content',$this->viewPrefix . $view,$data);
            return false;
        }
    }

    public function routeController(){
        return $this->routeAction()['controller'];
    }

    public function routeMethod(){
        return $this->routeAction()['method'];
    }

    public function routeAction(){
        list($class,$method) = explode('@',Route::current()->getActionName());
        return array(
            'controller'    =>  $class,
            'method'        =>  $method
        );
    }

    public function getIndex(){
        return Redirect::action($this->routeController().'@getList');
    }

    protected function paginateModels(){
        $models = array();
        if($this->model){
            $query = $this->model->whereNotNull('id');
            if(isset($this->model->orderBy)){
                $orderBy = $this->model->orderBy;
                $query->orderBy($orderBy['field'],$orderBy['order']);
            }
            else if(!(isset($this->model->timestamps) && !$this->model->timestamps)){
                $query->orderBy('created_at','desc');
            }
            $this->handleListQuery($query);
            $page = Input::has('_page') ? Input::get('_page') : 10;
            $models = $query->paginate($page);
        }
        return $models;
    }

    public function getList(){
        $models = $this->paginateModels();
        $data = array(
            'models'    =>  $models,
            $this->modelName.'s'    =>  $models,
            'params'    =>  Input::all()
        );
        $this->beforeList($data);
        $view = $this->makeView($data);
        if($view){
            return $view;
        }
    }

    public function getView($id){
        $model = $this->model->find($id);
        $data = array(
            'model' =>  $model,
            $this->modelName    =>  $model,
        );
        $this->beforeView($data);
        $this->makeView($data);
    }

    public function getEdit($id = null){
        if($id){
            $this->model = $this->model->find($id);
        }
        $data = array('id' => $id,'model'   =>  $this->model,$this->modelName=>$this->model);

        $this->makeView($data);
    }

    /**
     * @param $model
     * @param $relations
     * @return bool
     */
    protected function beforeSave($model, $relations)
    {
        return true;
    }

    protected function beforeList(&$data){

    }

    protected function beforeView(&$data)
    {

    }

    protected function handleListQuery(&$query)
    {
        if($this->model && method_exists($this->model,'filters') ){
            $modelName = $this->modelName;
            $filters = array_intersect_key($modelName::filters(),Input::all());
            foreach($filters as $field=>$option){
                $value = Input::get($field);
                if(isset($option['operator'])){
                    $query = $query->where($field,$option['operator'],$value);
                }else{
                    $query = $query->where($field,$value);
                }
            }
        }
    }
}
