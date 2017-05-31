<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/7
 * Time: 23:33
 */
$index = $slug ? $slug : 'index1';
?>
<div class="row">
    <div class="col-sm-9">
        {{View::make('demo.hacker.'.$index)}}
    </div>
    <div class="col-sm-3">
        <ul class="list list-group">
            @for($i=1;$i<=13;$i++)
                <li class="item list-group-item"><a href="{{URL::to('demo/hacker/index'.$i)}}" class="page" style="@if($index == 'index'.$i) <?='color:#f00'?> @endif" >示例代码{{$i}}</a></li>
            @endfor
        </ul>
    </div>
</div>

<script>
    $('pre').addClass('brush: jscript')
</script>