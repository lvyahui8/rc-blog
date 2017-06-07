/**
 * Created by lvyahui on 2016/1/23.
 */
;
function initAjaxForm($form,callback){
    $form.submit(function(){
        console.log('click');
        $.post($form.attr('action'),$form.serialize()/*new FormData($form[0])*/,function(resp){
            if(typeof callback !== "undefined"){
                callback(resp);
            }
        });
        return false;
    });
}

function refreshFrame(){
    if(window.parent){
        window.parent.refreshHeight();
    }
}

function isIE(ver){
    var b = document.createElement("b");
    b.innerHTML = "<!--[if IE " + ver + "]><i></i><![endif]-->";
    return b.getElementsByTagName("i").length === 1;
}

function loginModal(onOK){
    /*弹出登录框*/
    var $frame = $('<iframe>');
    $baseModal.find('.modal-title').text('Login');
    $baseModal.find('.modal-body').html($frame);
    $frame.attr('src','http://' + location.host + '/oauth/qc-login');
    /*
    $frame.load(function(){
        // 注册一段css
        var doc = document,
            loginDoc = $frame[0].contentDocument,
            css = doc.createElement('link');
            copyCss = loginDoc.createElement('style');
        css.href = 'http://' +  location.host + '/css/login.css';
        // 将link的文件内容复制到style体中
        copyCss.sheet = css.sheet;
        loginDoc.head.appendChild(copyCss);
    });
    */
    $frame.addClass('login-frame');
    $baseModal.modal('show');
    if(typeof onOK !== 'undefined'){
        $baseModal.on('hidden.bs.modal',function(){
            if($baseModal.data('login') === 1){
                onOK();
            }
        });
        //onOK();
    }
}

var $baseModal = $('div#base-modal.modal');

(function ($){
    $(document).ready(function(){
        if($.isFunction($.fn.select2)){
            var defaults = {
                lang : 'zh-CN'
            };
            for(var opt in defaults){
                if(defaults.hasOwnProperty(opt)){
                    $.fn.select2.defaults.set(opt,defaults[opt]);
                }
            }
            $('select.select2').select2();
        }

        /* 异步加载的局部界面 */
        $('div[data-ajax-url]').each(function(){
            var $container = $(this);
            $container.on('container.refresh',function(){
                //console.log('container.refresh');
                $.get($container.data('ajax-url'),function(resp){
                    $container.html(resp);
                    // 刷新frame
                    refreshFrame();
                },'html');
            });
            if($container.data('onload') !== 'false'){
                $container.trigger('container.refresh');
            }
        });

        if(typeof SyntaxHighlighter !== "undefined"){
            SyntaxHighlighter.autoloader(
                ['php','/js/syntaxhighlighter/scripts/shBrushPhp.js'],
                ['java','/js/syntaxhighlighter/scripts/shBrushJava.js'],
                ['js','jscript','javascript','/js/syntaxhighlighter/scripts/shBrushJScript.js'],
                ['css','/js/syntaxhighlighter/scripts/shBrushCss.js'],
                ['xml','/js/syntaxhighlighter/scripts/shBrushXml.js'],
                ['sql','/js/syntaxhighlighter/scripts/shBrushSql.js'],
                ['cpp','c++','c','/js/syntaxhighlighter/scripts/shBrushCpp.js']
            );
            SyntaxHighlighter.defaults.toolbar = false;
            SyntaxHighlighter.all();
        }
    });
})($ || jQuery);

