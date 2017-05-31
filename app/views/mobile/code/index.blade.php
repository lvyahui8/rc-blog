<div class="code-container">
    @include('mobile.code.list')
</div>

<div class="infinite-scroll-preloader">
    <div class="preloader"></div>
</div>
@section('page.level.script')
    <script>
        var loading  = false,
                page = 1,
                $pContainer = $('div.code-container')
                ;
        var load = function(){
            $.get('{{url('code/list?page=')}}' + page,function(html){
                if(!html || html.trim() === ''){
                    // 加载完毕，则注销无限加载事件，以防不必要的加载
                    $.detachInfiniteScroll($('.infinite-scroll'));
                    // 删除加载提示符
                    $('.infinite-scroll-preloader').remove();
                    $pContainer.append('<div style="text-align: center;color: #999;line-height: 2.1rem;">已经没有了</div>');
                }
                $pContainer.append(html);
                page ++ ;
                loading = false;
            });
        };
        $(document).on('infinite',
                '.infinite-scroll-bottom',function() {
                    if(loading) return;
                    loading = true;
                    load();
                });
        load();
    </script>
@endsection