/**
 * Created by lvyahui on 16-1-31.
 */
var refreshHeight = function(){
    var $this = $container,
        minHeight = $('.page-right').height() - $('.top-menu').height() - 20,
        contentHeight = $this.contents().find('body').height() + 10;
    $this.height(contentHeight < minHeight ? minHeight : contentHeight);
};

;(function($){
    $(document).ready(function(){
        /*
        * 单页代码
        * */
        $container = $('div.page-body > iframe');

        var initPage = location.hash.split('#')[1],
            $active = $('nav li.active');

        window.onhashchange = function(){
            $container.attr('src',location.hash.substring(1));
        };

        if(initPage != undefined){
            $container.attr('src',initPage);
        }

        $('a[target="contentFrame"]').click(function(){
            var $this = $(this),
                url = $this.attr('href'),
                mainHost = location.host,
                i = url.indexOf(mainHost);
            $active.removeClass('active');
            $active = $this.parent('li');
            $active.addClass('active');
            if(i !== -1){
                url = url.substr(i + mainHost.length);
            }
            window.location.hash = '#' + url;
            return false;
        });

        $container.load(function(){
            refreshHeight();
        });

        refreshHeight();
        /*
         * 初始化代码
         */
        if($.isFunction($.fn.audioPlayer)){
            $('.audioPlayer').audioPlayer();
        }
        if(window.localStorage){
            var $window = $(window);
            $window.on('beforeunload',function(){
                console.log('-1');
                localStorage.framePage = localStorage.framePage - 1;
                //localStorage.setItem('framePage',Number(localStorage.getItem('framePage')) - 1);
            });
            //$window.bind('storage',function(){
            //    console.log('storage change');
            //});
            window.addEventListener("storage", function(e){
                console.log("oldValue: "+ e.oldValue + " newValue:" + e.newValue)
            });
        }
    });
})($ || jQuery);