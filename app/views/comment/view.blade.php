<div class="panel panel-primary">
    <div class="panel-body">
        <h5 class="user-info"><img src="{{asset('uploads/images/'.($comment->user_id ? $comment->user->avatar : 'hacker.ico'))}}" class="img-circle" width="18px"> {{$comment->user_id ? $comment->username : '匿名用户'}}：</h5>
        <p>{{$comment->content}}</p>
        <span>{{$comment->created_at}}</span>
    </div>
</div>