<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','IndexController@getIndex');
Route::controller('json','JsonController');

Route::group(array('before'=>'index'),function(){
    Route::get('site/404','SiteController@error404');
    Route::controller('demo','DemoController');
    Route::controller('code','CodeController');
    Route::controller('test','TestController');
    Route::controller('site','SiteController');
    Route::controller('oauth','OauthController');
    Route::controller('user','UserController');
    Route::controller('blog','BlogController');
    Route::controller('code','CodeController');
    Route::controller('comment','CommentController');
    Route::controller('project','ProjectController');
    Route::controller('about','AboutController');
    Route::controller('cron','CronController');
    Route::get('resume/index.html','ResumeController@getIndex');
    Route::get('resume','ResumeController@getIndex');
    Route::controller('resume','ResumeController');
});

Route::group(array('prefix'=>'admin','before' => 'admin'),function(){
    Route::controller('blog','admin\BlogController');
    Route::controller('code','admin\CodeController');
    Route::controller('comment','admin\CommentController');
    Route::controller('user','admin\UserController');
});

Route::group(array('before'=>'auth'),function(){

});


Route::group(array('before'=>'admin'),function(){
    Route::get('admin','admin\AdminController@getIndex');
});