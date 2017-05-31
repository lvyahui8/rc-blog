<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?=isset($navMap[$stdName]['text']) ?$navMap[$stdName]['text'] : strtoupper($stdName)?>列表</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12" >
                <div class="btn-group btn-group-sm" role="group">
                    @if($listOption['create'])
                    <a href="{{URL::to('admin/'.$stdName.'/edit')}}" class="btn btn-primary">新建</a>
                    @endif
                    <a class="btn btn-danger">删除</a>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><input type="checkbox" name=""></th>
                <?php foreach($config['list'] as $filed=>$settings):?>
                <th><?=is_array($settings) && isset($settings['alias']) ? $settings['alias'] : strtoupper($filed)?></th>
                <?php endforeach;?>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($models as  $model):?>
            <tr>
                <td><input type="checkbox" name=""></td>
                <?php foreach($config['list'] as $filed=>$settings):?>
                <?php
                $value =   $model->$filed;
                if(is_array($settings) && isset($settings['type'])){
                    if($settings['type'] === 'translate'){
                        $translate = $settings['translate'];
                        $value = $translate($value);
                    }
                }
                ?>
                <td>{{$value}}</td>
                <?php endforeach;?>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        @if($listOption['update'])
                            <a href="{{URL::to('admin/'.$stdName.'/edit/'.$model->id)}}" class="btn btn-primary">编辑</a>
                        @endif
                        @if($listOption['delete'])
                            <a href="{{URL::to('admin/'.$stdName.'/delete/'.$model->id)}}" class="btn btn-danger">删除</a>
                        @endif
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="pull-right">
            {{$models->appends(Input::all())->links()}}
        </div>
    </div>
</div>