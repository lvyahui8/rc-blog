<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/7
 * Time: 23:27
 */
?>


<canvas id="canvas"></canvas>
<script>
    var canvas = document.querySelector('#canvas') || document.getElementById('canvas'),
            chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';

    function drawHacker(canvas,width,height){
        var ctx = canvas.getContext('2d'),
                fh = 11,fw = 11,
                str = 'lvyahui2devl';
        canvas.width = width;
        canvas.height = height;
        var hexMap = (function(){
            var map = [];
            for(var i = 0;i<16;i++){
                map[Number(i).toString(16)] = i;
                if(i > 9){
                    map[i] = Number(i).toString(16);
                }
            }
            return map;
        })();

        function verticalStr(ctx,str,x,y){
            var opacity = 1;
            for(var i = 0;i < str.length; i++){
                ctx.fillStyle = 'rgba(0,255,0,'+Number(opacity).toString()+')';
                ctx.fillText(str.charAt(i),x, y);
                y -= fh;
                opacity -= 0.05;
            }
        }

        var randY = function () {
                    return -(Math.random() * 100);
                },
                randomChar = function(){
                    return chars.charAt(Math.floor(Math.random() * chars.length));
                },
                randomStr = function(len){
                    var str = '';
                    for(var i = 0 ;i < len;i++){
                        str += randomChar();
                    }
                    return str;
                },
                ySquence =  function(){
                    var arr = [];
                    for(var i = 0;i < (width / fw);i ++){
                        arr.push(randY());
                    }
                    return arr;
                },cSquence = function(){
                    var arr = [];
                    for(var i = 0;i < (width / fw);i ++){
                        arr.push(randomStr(Math.floor(Math.random() * 16)));
                    }
                    return arr;
                };
        var  x2ys = ySquence(),
                xChars = cSquence();
        var draw = function(){
            ctx.fillStyle = '#000';
            ctx.fillRect(0,0,width,height);
            //
            x2ys.map(function(y,index){
                var x = Math.floor(index * fw);
                verticalStr(ctx,xChars[index],x,y);
                x2ys[index] = y > height ? randY() : y +fh;
                // 字蛇头坐标>黑框的高度+字蛇的高度
                if(y > (height + fh * xChars[index].length)){
                    x2ys[index] = randY();
                }else{
                    x2ys[index] = y + fh;
                }
            });
        };
        setInterval(draw,50);
    }

    drawHacker(canvas,500,500);
</script>

<pre>
&lt;canvas id="canvas"&gt;&lt;/canvas&gt;
&lt;script&gt;
    var canvas = document.querySelector('#canvas') || document.getElementById('canvas'),
            chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';

    function drawHacker(canvas,width,height){
        var ctx = canvas.getContext('2d'),
                fh = 11,fw = 11,
                str = 'lvyahui2devl';
        canvas.width = width;
        canvas.height = height;
        var hexMap = (function(){
            var map = [];
            for(var i = 0;i&lt;16;i++){
                map[Number(i).toString(16)] = i;
                if(i &gt; 9){
                    map[i] = Number(i).toString(16);
                }
            }
            return map;
        })();

        function verticalStr(ctx,str,x,y){
            var opacity = 1;
            for(var i = 0;i &lt; str.length; i++){
                ctx.fillStyle = 'rgba(0,255,0,'+Number(opacity).toString()+')';
                ctx.fillText(str.charAt(i),x, y);
                y -= fh;
                opacity -= 0.05;
            }
        }

        var randY = function () {
                    return -(Math.random() * 100);
                },
                randomChar = function(){
                    return chars.charAt(Math.floor(Math.random() * chars.length));
                },
                randomStr = function(len){
                    var str = '';
                    for(var i = 0 ;i &lt; len;i++){
                        str += randomChar();
                    }
                    return str;
                },
                ySquence =  function(){
                    var arr = [];
                    for(var i = 0;i &lt; (width / fw);i ++){
                        arr.push(randY());
                    }
                    return arr;
                },cSquence = function(){
                    var arr = [];
                    for(var i = 0;i &lt; (width / fw);i ++){
                        arr.push(randomStr(Math.floor(Math.random() * 16)));
                    }
                    return arr;
                };
        var  x2ys = ySquence(),
                xChars = cSquence();
        var draw = function(){
            ctx.fillStyle = '#000';
            ctx.fillRect(0,0,width,height);
            //
            x2ys.map(function(y,index){
                var x = Math.floor(index * fw);
                verticalStr(ctx,xChars[index],x,y);
                x2ys[index] = y &gt; height ? randY() : y +fh;
                // 字蛇头坐标&gt;黑框的高度+字蛇的高度
                if(y &gt; (height + fh * xChars[index].length)){
                    x2ys[index] = randY();
                }else{
                    x2ys[index] = y + fh;
                }
            });
        };
        setInterval(draw,50);
    }

    drawHacker(canvas,500,500);
&lt;/script&gt;
</pre>