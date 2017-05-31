@foreach(isset($newPosts) ? $newPosts : $posts as $post)
    <a href="{{URL::to('blog/view/'.$post->id)}}" class="data" style="color: #000;">
        <div class="card">
            <div class="card-header">{{$post->title}}</div>
            <div class="card-content">
                <div class="card-content-inner text-nowrap"
                     style="word-break: break-all; word-wrap:break-word;">{{$post->short}}</div>
            </div>
            <div class="card-footer">{{$post->created_at}}</div>
        </div>
    </a>
@endforeach