<?php
$stdName = $ctrl->getStdName();
$routeMethod = $ctrl->routeMethod();
$subIndex = $routeMethod === 'getIndex';
$navMap = array(
        'site'  =>  array(
                'url'   =>  URL::to(''),
                'text'  =>  '首页'
        ),
        'demo'  =>  array(
        ),
        'resume' =>  array(
                'text'  =>  '简历'
        ),
        'blog'  =>  array(
                'text'  =>  '博客',
                'url'   =>  URL::to('blog/list'),
        ),
        'project'=> array(
                'text'  =>  '项目',
        ),
        'code'  =>  array(
                'text'  =>  '微码'
        ),
        'test'  =>  array(

        ),
);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.head')
    <script>
        var frame$ = window.parent.jQuery;
    </script>
</head>
<body>
<div class="container-fluid">{{$content}}</div>
@include('layouts.footer')
<script>
    $('a').click(function(){
        var url = $(this).attr('href')
        if(url && url != '#' && url.indexOf('http') == 0){
            var mainHost = window.parent.location.host,
                    i = url.indexOf(mainHost);
            if(i !== -1){
                url = url.substr(i + mainHost.length);
            }
            window.parent.location.hash = '#' + url;
        }
        return false;
    });
    //    document.getElementsByTagName('a').onclick = function(){
    //        window.parent.location.hash = '#' + this.href;
    //    };
</script>
@yield('footerScript','')
</body>
</html>