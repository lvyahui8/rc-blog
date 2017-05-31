<?php
$ctrl->registStyle('js/syntaxhighlighter/styles/shCoreRDark.css');
$ctrl->registScript('js/syntaxhighlighter/scripts/shCore.js');
$ctrl->registScript('js/syntaxhighlighter/scripts/shAutoloader.js');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>{{$code->title}}</h3>
                <p>{{$code->created_at}} {{$code->view_ct }} 次浏览</p>
                <div class="row">
                    <div class="col-sm-12">
                            {{$code->short}}
                    </div>
                </div>
                <div class="code">
                    <pre class="brush: {{$code->lang}};">{{$code->body}}</pre>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-left">
                            <a @if($prevCode) href="{{URL::to('code/view/'.$prevCode->id)}}" @else class="disabled" @endif>上一篇:{{$prevCode != null ? $prevCode->title : '没有了'}}</a>
                        </div>
                        <div class="pull-right">
                            <a @if($nextCode) href="{{URL::to('code/view/'.$nextCode->id)}}" @else class="disabled" @endif>下一篇:{{$nextCode != null ? $nextCode->title : '没有了'}}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4>评论</h4>
                <div class="panel">
                    <div class="panel-body">
                        <div id="comments-container" data-ajax-url="{{URL::to('comment/list?proj_type=code&proj_id='.$code->id)}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

