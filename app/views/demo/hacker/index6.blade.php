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
    /*
     * 屏幕坐标体系，x为水平方向向右递增，y为垂直向下递增
     */
    var canvas = document.querySelector('#canvas') || document.getElementById('canvas');

    function drawHacker(canvas,width,height){
        var ctx = canvas.getContext('2d'),
                fh = 11,fw = 11,
                str = 'lvyahui',
                y = 0;
        function verticalStr(ctx,str,x,y){
            for(var i = 0;i < str.length; i++){
                ctx.fillStyle = "#0f0";
                ctx.fillText(str.charAt(i),x, y);
                y -= fh;
            }
        }
        var draw = function(){
            ctx.fillStyle = '#000';
            ctx.fillRect(0,0,width,height);
            //
            var  x = Math.floor(width / 2),cy = y;
            verticalStr(ctx,str,x,cy);
            y = y > height ? 0 : y +fh;
        };
        setInterval(draw,50);
    }

    drawHacker(canvas,500,300);
</script>

<pre>
&lt;canvas id="canvas"&gt;&lt;/canvas&gt;
&lt;script&gt;
    /*
     * 屏幕坐标体系，x为水平方向向右递增，y为垂直向下递增
     */
    var canvas = document.querySelector('#canvas') || document.getElementById('canvas');

    function drawHacker(canvas,width,height){
        var ctx = canvas.getContext('2d'),
                fh = 11,fw = 11,
                str = 'lvyahui',
                y = 0;
        function verticalStr(ctx,str,x,y){
            for(var i = 0;i &lt; str.length; i++){
                ctx.fillStyle = "#0f0";
                ctx.fillText(str.charAt(i),x, y);
                y -= fh;
            }
        }
        var draw = function(){
            ctx.fillStyle = '#000';
            ctx.fillRect(0,0,width,height);
            //
            var  x = Math.floor(width / 2),cy = y;
            verticalStr(ctx,str,x,cy);
            y = y &gt; height ? 0 : y +fh;
        };
        setInterval(draw,50);
    }

    drawHacker(canvas,500,300);
&lt;/script&gt;
</pre>