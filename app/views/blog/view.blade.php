<?php
$ctrl->registStyle('js/syntaxhighlighter/styles/shCoreRDark.css');
$ctrl->registScript('js/syntaxhighlighter/scripts/shCore.js');
$ctrl->registScript('js/syntaxhighlighter/scripts/shAutoloader.js');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>{{$post->title}}</h3>
                <p>{{$post->created_at}} {{$post->view_ct }} 次浏览 @if($post->cnblogs_url) <code>去<a target="_parent" onclick="window.parent.open('{{$post->cnblogs_url}}')" >博主博客园</a>看原文</code>@endif</p>
                <p></p>
                <div class="row">
                    <div class="col-sm-12">
                        <blockquote>
                            <p>
                                {{$post->short}}
                            </p>
                        </blockquote>
                    </div>
                </div>
                {{$post->content}}
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-left">
                            <a @if($prevPost) href="{{URL::to('blog/view/'.$prevPost->id)}}" @else class="disabled" @endif>上一篇:{{$prevPost != null ? $prevPost->title : '没有了'}}</a>
                        </div>
                        <div class="pull-right">

                            <a @if($nextPost) href="{{URL::to('blog/view/'.$nextPost->id)}}" @else class="disabled" @endif>下一篇:{{$nextPost != null ? $nextPost->title : '没有了'}}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-primary comments-component">
            <div class="panel-body">
                <h4>评论</h4>
                <div class="panel">
                    <div class="panel-body">
                        <div id="comments-container" data-ajax-url="{{URL::to('comment/list?proj_type=post&proj_id='.$post->id)}}" data-onload="false"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

