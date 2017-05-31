<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{HTML::script('js/jquery-1.11.0.min.js')}}
</head>
<body>
<script>
    $(document).ready(function(){
        window.parent.location.hash = '#' + location.href;
    });
</script>
</body>
</html>