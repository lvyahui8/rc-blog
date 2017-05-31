<div id="apps_container">
    <div class="app_container full" data-num="0">
        <div class="app app2x2 app_orange animation unloaded" data-theme="orange">
            <div class="app_content">
                <a href="{{URL::to('demo/hacker')}}">
                    <div class="main" style="background-image:url('{{asset('images/Hacker_96px_1185123_easyicon.net.ico')}}');">
                        <span>黑客帝国刷屏</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="app app2x2 app_red app_link animation unloaded" data-theme="red">
            <div class="app_content">
                <a href="{{URL::to('demo/data-table')}}">
                    <div class="main" style="background-image: url('{{asset('images/table_edit_72px_1082316_easyicon.net.ico')}}');">
                        <span>Excel表格</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="app app2x2 app_darkblue animation unloaded" data-theme="darkblue">
            <div class="app_content">
                <a onclick="window.parent.open('{{URL::to('dbuilder/admin')}}')">
                    <div class="main" style="background-image:url('{{asset('images/dbuilder.gif')}}');">
                        <span>DBuilder</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


@section('styles')
    {{HTML::style('css/metro.css')}}
@stop
@section('scripts')
    {{HTML::script('js/metro.js')}}
@stop
