<div id="comments">
    @foreach($comments as $comment)
        {{View::make('comment.view',array('comment'=>$comment))}}
    @endforeach
</div>
<form id="comment-form" action="{{URL::to('comment/edit')}}" method="post" class="form-horizontal">
    <input type="hidden" name="proj_type" value="{{$params['proj_type']}}">
    @if(isset($params['proj_id']))
    <input type="hidden" name="proj_id" value="{{$params['proj_id']}}">
    @endif
    <div class="form-group">
        <label for="" class="sr-only">说两句</label>
        <div class="col-sm-12">
            <textarea name="content" id="content" class="form-control" rows="10" placeholder="吐槽一下"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-10">
            <button type="submit" class="btn btn-primary btn-block @if(Auth::guest()) guest @endif">发表</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(){
        var $commForm = $('form#comment-form');
         initAjaxForm($commForm,function(resp){
//             $('div#comments-container').trigger('container.refresh');
             if(resp.success){
                 $('div#comments').prepend(resp.html);
                 $('textarea[name="content"]').val('');
                 refreshFrame();
             }
         });

        $commForm.find('button.guest[type="submit"]').click(function(){
            var $btn = $(this);

            loginModal(function(){
                $.get('{{URL::to('user/info')}}',function(resp){
                    window.parent.$('ul#user-info').html(resp);
                });
                $commForm.submit();
                $btn.removeClass('guest');
                $btn.unbind('click');
            });

            return false;
        });
    });
</script>
