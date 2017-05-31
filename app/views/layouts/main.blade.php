<!DOCTYPE html>
<html lang="zh-CN">
<head>
    @include('layouts.admin.head')
</head>
<body>
<?php
$stdName = $ctrl->getStdName();
$routeMathod = $ctrl->routeMethod();
$subIndex = $routeMathod === 'getIndex';
$navMap = array(
        'site'  =>  array(
                'url'   =>  URL::to(''),
                'text'  =>  '首页'
        ),
        'blog'  =>  array(
                'text'  =>  '博客',
        ),
        'code'  =>  array(
                'text'  =>  '微码'
        ),
        'comment'  =>  array(
                'text'  =>  '评论'
        ),
        'user'      =>  array(
            'text'  =>  '用户'
        )
);
?>
<div class="wrap">
    @include('layouts.admin.menu')
    <div class="container">
        <?php if($stdName !== 'site'):?>
        <ol class="breadcrumb">
            <li><a href="<?=URL::to('')?>">首页</a></li>
            <li>
                <a href="<?=isset($navMap[$stdName]['url']) ? $navMap[$stdName]['url'] : URL::to('admin/'.$stdName.'/list')?>"
                   class="<?=$subIndex ? 'active' : null?>">
                    <?=isset($navMap[$stdName]['text']) ?$navMap[$stdName]['text'] : strtoupper($stdName)?>
                </a>
            </li>
            <?php if(!$subIndex):?>
            <li class="active"><?=strtoupper($routeMathod)?></li>
            <?php endif;?>
        </ol>
        <br>
        <?php endif;?>
        <div class="row">
            <div class="col-sm-12">
                {{$content}}
            </div>
        </div>
    </div>
    <br>
    @include('layouts.admin.footer')
</div>
@yield('footerScript','')
</body>
</html>