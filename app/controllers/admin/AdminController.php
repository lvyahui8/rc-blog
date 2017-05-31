<?php

namespace admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class AdminController extends \BaseController
{
    protected $layout = 'layouts.main';

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();


        $this->assignModel($this->model);
    }

    public function getList(){
        $models = $this->paginateModels();
        $this->makeView(array(
            'models'  =>  $models,
            'config'    =>  $this->savedConfig,
            'stdName'   =>  $this->getStdName(),
            'list'  =>  $this->savedConfig['list'],
            'listOption'    =>  $this->savedConfig['listOption']
        ),'admin.core.list');
    }

    public function getEdit($id = null)
    {
        if($id){
            $this->model = $this->model->find($id);
        }
        $data = array(
            'id' => $id,
            'model'   =>  $this->model,
            $this->modelName=>$this->model,
            'items' =>  $this->savedConfig['items'],
            'stdName'   =>  $this->getStdName(),
            'formOption'   =>   $this->savedConfig['formOption'],
        );
        $this->makeView($data,'admin.core.form');
    }

    protected function config(){
        return array(
            'items' =>  array(),
            'list'  =>  array(),
        );
    }

    protected function assignModel($model)
    {
        $this->model = $model;

        $config = $this->config();

        if (isset($config['items']))
        {
            foreach ($config['items'] as $field=>&$item)
            {
                $item = array_merge(array(
                    'label'=>$field,
                    'type'=>'text',
                    'rule'=>'',
                    'save'=>true,
                    'freshOnly'=>false,
                    'placeholder'=>'',
                ), $item);

                if (isset($item['value']))
                {
                    $this->model->$field = $item['value'];
                }
            }
        }else{
            $config['items']    = array();
        }
        if (! isset($config['listOption'])) $config['listOption'] = array();
        if (! isset($config['formOption'])) $config['formOption'] = array(
            'cols'  =>  8,
            'labelCols' =>  2,
            'inputCols' =>  10
        );
        $config['listOption'] = array_merge(array(
            'itemsPerPage'=>10,
            'create'    =>  true,
            'update'    =>  true,
            'delete'    =>  true,
        ), $config['listOption']);

        $this->savedConfig = $config;
    }

    public function postEdit($id = null){
        if ($id || Input::has('id'))
        {
            $this->model = $this->model->find(Input::has('id') ? Input::get('id') : $id);
        }
        $resp = Redirect::action(get_class($this).'@getEdit', array('id'=>Input::get('id')))->withInput();
        $relations  = array();
        $items = $this->savedConfig['items'];
        foreach($items as $field => $item){
            $value  = Input::get($field);
            if($item['save'] && $item['type'] !== 'relation'){
                $this->model->$field = $value;
            }else if($item['save']){
                if(is_array($value)){
                    foreach($value as $v){
                        $relations[$field][] = $this->model->$field()->getRelated()->find($v);
                    }
                }else{
                    $relations[$field][] =
                        $this->model->$field()->getRelated()->find($value);
                }
            }
        }

        if($this->beforeSave($this->model,$relations) && $this->model->save()){
            $resp = Redirect::action(get_class($this).'@getList')->withMessage('save success!');
        }
        return $resp;
    }

    public function getIndex()
    {
        $this->makeView(null,'admin.index');
    }


    public function getDelete($id){
        $this->beforeDelete($id);
        $this->model->where('id',$id)->delete();
        return Redirect::action(get_class($this).'@getList');
    }

    public function missingMethod($parameters = array())
    {
        //
        $this->makeView(null,'site.404');
    }

    protected function handleListQuery(&$query)
    {
        if(isset($this->savedConfig['listOption']) && isset($this->savedConfig['listOption']['filters'])){
            $filters = array_intersect_key($this->savedConfig['listOption']['filters'],Input::all());
            foreach($filters as $field=>$option){
                $value = Input::get($field);
                if($value !== ''){
                    if(isset($option['operator'])){
                        if($option['operator'] === 'like'){
                            $value = '%'.$value.'%';
                        }
                        $query = $query->where($field,$option['operator'],$value);
                    }else{
                        $query = $query->where($field,$value);
                    }
                }
            }
        }
    }

    protected function beforeDelete($id)
    {
    }

    public function getBlogPull(){
        $pullCmd = new \PullCommand();
        $pullCmd->fire();
        exit;
    }
}
