{{--@section('styles')--}}
{{--{{HTML::style('fonts/ChopinScript/ChopinScript.css')}}--}}
{{--@append--}}
<style type="text/css" title="">

    /* 定义菜单CSS */
    #menu {
        width: 100%;
        position: absolute;
        top: 40%;
        left: 0;
        /*height:700px;*/
    }

    /* 定义菜单项目 */

    #one, #two, #three, #four {
        position: relative;
        height: 100%;
        float: left;
        /* 这里添加基于CSS3的过渡效果，整体菜单效果更好 */
        transition: all 0.5s;
        /* 浏览器兼容代码 */
        moz-transition: all 0.5s;
        -webkit-transition: all 0.5s;
    }

    /* 定义每一个菜单项目背景色 */
    /*#one{*/
    /*background: #8d48ed;*/
    /*}*/

    /*#two{*/
    /*background: #08a3ca;*/
    /*}*/

    /*#three{*/
    /*background: #94b804;*/
    /*}*/
    .item-content {
        padding: 5px;
    }
</style>
<script>
    document.body.style.background = 'none';
    $(function () {
        /*
         var $current;
         $('#menu > div').mouseenter(function () {
         var $this = $(this);
         if ($current) {
         $current.stop().css({"width": "33%", "margin-top": '0'}).siblings().css({"width": "33%"});
         $current.find('div.item-content').addClass('hidden');
         }
         $current = $this;
         $this.stop().css({"width": "60%", "margin-top": '-16%'}).siblings().css({"width": "20%"});
         $this.find('div.item-content').removeClass('hidden');
         });
         */
    });
</script>
<div class="row" id="menu">

    <div id="one" class="col-sm-4">
        <div class="center-block">
            <img class="img-responsive center-block" src="{{asset('images/speech.png')}}" alt="">
            <div class="item-content hidden">
                <ul class="media-list">
                    @foreach($newComments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle"
                                         src="{{ asset('uploads/images/'.($comment->user_id ? $comment->user->avatar : 'hacker.ico' ))}}"
                                         width="36px" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">{{$comment->user_id ? $comment->user->username : '匿名用户'}}</h5>
                                <a href="{{$comment->url}}">Re:</a>{{$comment->content}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div id="two" class="col-sm-4">
        <div class="center-block">
            <img class="img-responsive  center-block" src="{{asset('images/video.png')}}" alt="">
            <div class="item-content hidden">
                <div id="player_a" class="projekktor" style="margin: 0 auto"></div>
            </div>
        </div>

    </div>
    <div id="three" class="col-sm-4">
        <div class="center-block">
            <img class="img-responsive center-block" src="{{asset('images/avatar.png')}}" alt="">
            <div class="item-content hidden">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="{{asset('images/qq2w.jpg')}}" alt="QQ二维码">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading" style="font-family: 'ChopinScript';">Lv Yahui</h3>
                                <mark>WEB开发</mark>
                                工程师（WEB Development Engineer）
                                <p class="text-right">

                                </p>
                                <dl class="dl-horizontal pull-right pull-bottom">
                                    <dt>邮箱</dt>
                                    <dd>
                                        <a href="mailto:#">lvyahui8@126.com</a><br>
                                        <a href="mailto:#">1257069082@qq.com</a><br>
                                    </dd>
                                    <dt>QQ</dt>
                                    <dd><a href="tencent://message/?uin=1257069082">1257069082</a></dd>
                                    <dt>微信</dt>
                                    <dd>Agrin_DJ_2012</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@section('styles')
    {{HTML::style('plugins/projekktor/themes/maccaco/projekktor.style.css')}}
@stop

@section('scripts')
    {{HTML::script('plugins/projekktor/projekktor-1.3.09.min.js')}}
@stop

@section('footerScript')
    <script type="text/javascript">
        $(document).ready(function () {
            var $audioPlayer = window.parent.jQuery('div.main'),
                    $window = $(window);
            $audioPlayer.find('div.pause').click();

            var $current,
                    $container = $('#menu > div'),
                    isFinish = false,
                    width = window.screen.width > 1600 ? 854 : 598,
                    height =window.screen.width > 1600 ? 480 : 336;

            var divAnimation = function () {
                var $this = $(this);
                if ($current) {
                    $current.stop().css({"width": "33%", "margin-top": '0'}).siblings().css({"width": "33%"});
                    $current.find('div.item-content').addClass('hidden');
                }
                $current = $this;
                $this.stop().css({"width": "60%", "margin-top": '-16%'}).siblings().css({"width": "20%"});
                $this.find('div.item-content').removeClass('hidden');
            };
            $container.mouseenter(divAnimation);

            projekktor('#player_a', {
                        poster: '{{asset('videos/jrayty-yzbp480p2.jpg')}}',
                        title: 'this is projekktor',
                        playerFlashMP4: '{{asset('plugins/projekktor/swf/StrobeMediaPlayback/StrobeMediaPlayback.swf')}}',
                        playerFlashMP3: '{{asset('plugins/projekktor/swf/StrobeMediaPlayback/StrobeMediaPlayback.swf')}}}',
                        volume: 0.8,
                        width: width,
                        height: height,
                        playlist: [
                            {
                                1: {src: "{{asset('videos/jrayty-yzbp480p.mp4')}}", type: "video/mp4"}
                            }
                        ],
                        enableFullscreen: true
                    }, function (player) {
                        $('img#player_a_media_image').css({
                            width: '100%',
                            height: '100%',
                            top: 0
                        });
                        player.addListener('state', function (state) {
                            switch (state) {
                                case 'IDLE':
                                    console.log('idle');
                                    break;
                                case 'PLAYING':
                                    console.log('p');
                                    // 在此处禁止事件
                                    $container.unbind('mouseenter');
                                    break;
                                case 'STARTING':
                                    console.log('start');
                                    break;
                                case 'STOPPED':
                                    console.log('STOPPED');
                                    break;
                                case 'COMPLETED':
                                    $container.mouseenter(divAnimation);
                                    if (!isFinish) {
                                        var $modal = $('div#base-modal');
                                        // $modal.find('h4.modal-title').text('友情提示');
                                        // $modal.find('div.modal-body').html('<b>你居然看完了，去看看这部电影吧：假如爱有天意，我看了三次了</b>');
                                        // $modal.modal('show');
                                        isFinish = true;
                                    }
                                    break;
                                case 'PAUSED':
//                                    console.log('PAUSED');
                                    $container.mouseenter(divAnimation);
                                    break;
                                default:
                                    break;
                            }
                        });
                        player.addListener('rightclick',function(){
                            alert('click');
                        });
                    }
            );
            $window.on('beforeunload', function () {
                $audioPlayer.find('div.play').click();
            });
        });
    </script>
@stop

@section('modals')

@stop
