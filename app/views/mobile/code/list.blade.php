@foreach(isset($codes) ? $codes : array() as $code)
<a href="{{URL::to('code/view/'.$code->id)}}" class="data" style="color: #000;">
    <div class="card">
        <div class="card-header">{{$code->title}}</div>
        <div class="card-content">
            <div class="card-content-inner text-nowrap"
                 style="word-break: break-all; word-wrap:break-word;">{{$code->short}}</div>
        </div>
        <div class="card-footer">{{$code->created_at}}</div>
    </div>
</a>
@endforeach