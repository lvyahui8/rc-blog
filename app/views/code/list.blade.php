<?php
//    $ctrl->registScript('js/jquery-syntax/jquery.syntax.min.js');

//        $ctrl->registStyle('js/highlight/styles/default.css');
//        $ctrl->registScript('js/highlight/highlight.pack.js');
$ctrl->registStyle('js/syntaxhighlighter/styles/shCoreRDark.css');
$ctrl->registScript('js/syntaxhighlighter/scripts/shCore.js');
$ctrl->registScript('js/syntaxhighlighter/scripts/shAutoloader.js');

?>
<div class="row">
    <div class="col-sm-8">
        <?php foreach($codes as $code):?>
        <div class="panel panel-primary focus-animation">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{URL::to('code/view/'.$code->id)}}"><h4 class="item-title">{{$code->title}}</h4></a>
                        <p>{{$code->short}}</p>
                        <div class="code">
                            <pre class="brush: {{$code->lang}};">{{substr($code->body,0,100)}}</pre>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <span>{{$code->view_ct}} 次阅读</span>
                        <span></span>
                    </div>
                    <div class="col-sm-4 ">
                        <span class="pull-right">{{$code->created_at}}</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">最热微码</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="list-group">
                            <?php foreach($hotCodes as $code):?>
                            <a href="{{URL::to('code/view/'.$code->id)}}" class="list-group-item">
                                <span>{{$code->title}}</span><span class="pull-right">{{$code->view_ct}}次</span>
                            </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footerScript')
@stop