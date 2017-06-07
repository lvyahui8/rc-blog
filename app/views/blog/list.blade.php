<div class="row">
    <div class="col-sm-8">
        <?php foreach($posts as $post):?>
        <div class="panel panel-primary focus-animation">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{URL::to('blog/view/'.$post->id)}}"><h4 class="item-title">{{$post->title}}</h4></a>
                                <p>{{$post->short }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <span>{{$post->view_ct}} 次阅读</span>
                                <span>@if($post->cnblogs_url) 来自<code><a target="_parent" class="code-link" onclick="window.parent.open('{{$post->cnblogs_url}}')" >博主博客园</a></code>@endif</span>
                            </div>
                            <div class="col-sm-4 ">
                                <span class="pull-right">{{$post->created_at}}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <div class="pull-right">
            {{$posts->appends(Input::all())->links()}}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">栏目</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="list-group">
                            <?php foreach($categorys as $category):?>
                            <a href="{{URL::to('blog/list?category_id='.$category->id)}}" class="list-group-item"><span class="badge">{{$category->post_ct}}</span>{{$category->title}}</a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">热门博文</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="list-group">
                            <?php foreach($hotPosts as $post):?>
                            <a href="{{URL::to('blog/view/'.$post->id)}}" class="list-group-item">
                                <span>{{$post->title}}</span><span class="pull-right">{{$post->view_ct}}次</span>
                            </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>