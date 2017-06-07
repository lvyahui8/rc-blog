<?php

/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/2/27
 * Time: 20:15
 */
use Illuminate\Support\Facades\Response;
class CommentController extends BaseController
{
    protected function handleListQuery(&$query)
    {
        $query->with('user');
        parent::handleListQuery($query); // TODO: Change the autogenerated stub
    }


    public function postEdit(){
        if(Input::get('content') !== '' && !Auth::guest()){
            $comment = new Comment();
            $comment->proj_type = Input::get('proj_type');
            if(Input::has('proj_id')){
                $comment->proj_id = Input::get('proj_id');
            }

            $user = Auth::user();
            $comment->user_id = $user->id;
            $comment->username = $user->username;

            $comment->content = Input::get('content');
            $comment->save();
            return Response::json(array(
                'success'=>true,
//            'comment'=>$comment,
//            'id'    =>  $comment->id,
                'html'  =>  View::make('comment.view',array('comment'=>$comment))->render(),
            ));
        }else{
            return Response::json(array(
                'success'   =>  false,
            ));
        }

    }
}