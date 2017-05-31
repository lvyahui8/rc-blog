<?php
$ctrl->registStyle('css/select2/select2.min.css');
$ctrl->registScript('js/select2/select2.full.min.js');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$id ? "编辑" : '新建'}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{URL::to('admin/blog/edit')}}">
                    <input type="hidden" id="id" name="id" value="{{$post->id}}">
                    <div class="form-group">
                        <label for="title" class="sr-only">标题</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="title" name="title" placeholder="标题" value="{{$post->title}}">
                        </div>
                        <label for="title" class="sr-only">类别</label>
                        <div class="col-sm-4">
                            <select class="form-control select2" name="category_id" id="category_id">
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="sr-only">正文</label>
                        <div class="col-sm-12">
                            <textarea class="form-control"
                                      id="content" name="content"
                                      rows="30"
                                      placeholder="正文内容">{{$post->content}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short" class="sr-only">摘要</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="short" name="short" placeholder="摘要" rows="5">{{$post->content}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags" class="sr-only"></label>
                        <div class="col-sm-12">
                            <select name="tags" id="tags" class="form-control select2" data-placeholder="文章标签"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-10">
                            <button type="submit" class="btn btn-block btn-primary">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
