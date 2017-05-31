@if(Auth::guest())
    <li><a id="qq-login"><img class="qq-login" src="{{asset('images/Connect_logo_4.png')}}" alt=""></a>
    </li>
@else
    <li><a href="{{URL::to('site/logout')}}">退出</a></li>
    <li><a><img class="avatar" src="{{asset('uploads/images/'.Auth::user()->avatar)}}" alt=""><span class="username">{{Auth::user()->username}}</span></a></li>

@endif