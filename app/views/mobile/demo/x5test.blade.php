<div class="" style="top: 4rem;position: absolute;">
    <form >
        <input type="text" id="number">
    </form>
<span id="console">

</span>
</div>


@section('page.level.script')
<script>
    var $input = $('input#number'),
            $console = $('span#console');
    $input.on('input',function(){
        $console.text('input');
        $.toast('input');
    }).on('change',function(){
        $.toast('change'); $console.text('change');
    }).on('propertychange',function(){
        $.toast('propertychange'); $console.text('propertychange');
    }).on('keyup',function(){
        $.toast('keyup'); $console.text('keyup');
    }).on('keydown',function(){
        $.toast('keydown'); $console.text('keydown');
    });
</script>
@endsection