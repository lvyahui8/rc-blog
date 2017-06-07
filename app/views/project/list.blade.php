<?php
        $ctrl->registScript('js/masonry.pkgd.min.js');
        $ctrl->registScript('js/imagesloaded.pkgd.min.js');
$key = 'projects';
if(!Cache::has($key)){
    Cache::forever($key,array(
            array(
                    'url'   =>  'http://wenwei.cc/',
                    'pic'   =>  asset('images/wenwei-thum.jpg'),
                    'bigPic'   =>  asset('images/wenwei.png'),
                    'name'   =>  '文微电子科技有限公司门户',
                    'desc'   =>  '展示用门户网站，主要做前端开发',
                    'role'  =>  '独立制作'
            ),
            array(
                    'url'   =>  'http://hnyhc.com/',
                    'pic'   =>  asset('images/hnyhc-thum.jpg'),
                    'bigPic'   =>  asset('images/hnyhc.png'),
                    'name'   =>  '湖南亿辉建筑有限公司门户',
                    'desc'   =>  '展示用门户网站，主要做前端开发',
                    'role'  =>  '独立制作',
            ),
            array(
                    'url'   =>  'http://www.aosaiban.com',
                    'pic'   =>  asset('images/aosaiban_thum.jpg'),
                    'bigPic'   =>  asset('images/aosaiban.jpg'),
                    'name'   =>  '奥赛班',
                    'desc'   =>  '负责开发前台搜索，个人中心，支付宝交易，互联登录，类似考题计算，后台管理，论坛系统等，项目基于yii+wecenter',
                    'role'  =>  '主要开发人员',
            ),
            array(
                    'url'   =>  'http://112.74.98.137/',
                    'pic'   =>  asset('images/weitou365_thum.jpg'),
                    'bigPic'   =>  asset('images/weitou365.jpg'),
                    'name'   =>  '微投网',
                    'desc'   =>  '负责大部分前后台开发，以及与宝付支付接口连接，基于laravel4',
                    'role'  =>  '主要开发人员',
            ),
            array(
                    'url'   =>  'http://cx.fzw580.com/user/login',
                    'pic'   =>  asset('images/fzwy_thum.jpg'),
                    'bigPic'   =>  asset('images/fzwy.jpg'),
                    'name'   =>  '法智物业管理',
                    'desc'   =>  '后台CRUD，数据报表，基于laravel4',
                    'role'  =>  '辅助开发人员'
            ),
            array(
                    'url'   =>  'http://www.taocloudx.com/',
                    'pic'   =>  asset('images/taocloud_thum.jpg'),
                    'bigPic'   =>  asset('images/taocloud.jpg'),
                    'name'   =>  '大道云行',
                    'desc'   =>  '负责web系统开发，以及rpc远程调用开发、agent开发',
                    'role'  =>  'web开发人员'
            ),

    ));
}
$projects = Cache::get($key);
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">已上线项目</div>
    </div>
    <div class="panel-body">
        <div class="row" id="proj-container">
            <?php foreach($projects as $project):?>
            <div class="col-sm-6 col-md-3 proj-item">
                <div class="thumbnail focus-animation">
                    {{--<img src="http://dummyimage.com/242x200/999/fff.gif&text=SitePic" alt="">--}}
                    <img src="{{$project['pic']}}" @if(isset($project['bigPic'])) data-big-src="{{$project['bigPic']}}" @endif alt="{{$project['name']}}" class="img-responsive">
                    <div class="caption">
                        <a target="_parent" onclick="window.parent.open('{{$project['url']}}')" style="cursor: pointer;">
                            <h3>{{$project['name']}}</h3>
                        </a>
                        <p>{{$project['desc']}}</p>
                        <span>角色：{{$project['role']}}</span>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<div class="modal" id="img-box" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">网站截图</h4>
            </div>
            <div class="modal-body">
                <div class="center-block center-align text-center">
                    <img src="" alt="" id="big-img" style="display: none;" class="img-responsive center-block center-align text-center">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footerScript')
    <script>
        $(document).ready(function(){
            var $imgBox = $('div#img-box'),
                    $bigImg = $imgBox.find('img#big-img'),
                    $projCt = $('div#proj-container'),
                    $loading = $imgBox.find('div.spinner');
            $('.thumbnail > img').click(function(){
                var src = $(this).data('big-src');
                if(!src){
                    src = $(this).attr('src');
                }
                $bigImg.hide();
                $loading.show();
                $imgBox.modal('show');
                $bigImg.attr('src',src);
                $imgBox.imagesLoaded(function(){
                    $loading.hide();$bigImg.show();
                })
            });
            $projCt.imagesLoaded(function(){
                $projCt.masonry({
                    // options
                    itemSelector: '.proj-item',
                    columnWidth: '.proj-item'
                });
            });
        });
    </script>
@stop