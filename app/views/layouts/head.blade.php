<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="@if($controller->desc){{$controller->desc}}@else对Web全端开发、Android开发有一定研究和理解，积累了近2年的Web开发经验。是一个努力不断改变自己追求完美的人，希望穷尽一生来深入互联网领域并取得成就。 @endif" />
<meta name="author" content="" />
<title>@if($controller->title != ''){{$controller->title}}-@endif若尘博客</title>
{{--{{HTML::style('css/bootstrap.css')}}--}}
{{--{{HTML::style('css/bootstrap-theme.css')}}--}}
{{HTML::style('css/commons.css?v=100')}}

{{HTML::script('js/jquery-1.11.0.min.js')}}
<!--[if lt IE 9]>{{HTML::script('js/ie8-responsive-file-warning.js')}}<![endif]-->

<!--[if lt IE 9]>
{{HTML::script('js/html5shiv.js')}}
{{HTML::script('js/respond.min.js')}}
<![endif]-->