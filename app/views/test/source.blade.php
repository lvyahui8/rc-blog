@section('styles')
{{HTML::style(asset('plugins/zTree/css/metroStyle/metroStyle.css'))}}
{{HTML::style(asset('plugins/zTree/css/styles.css'))}}
@stop
@section('scripts')
{{HTML::script(asset('plugins/zTree/js/jquery.ztree.core.js'))}}
@stop
<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>
@section('footerScript')
    <script>
        var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting = {
            async  :    {
                enable  :   true,
                url :   '{{URL::to('test/ls')}}',
                autoParam : ['id',"name","path","level"],
                otherParam : {"user_id":1},
                dataType : 'json'
            }
        };
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes = [{name:'{{basename(base_path())}}',path:"{{base_path()}}",isParent:true,open:true}];
        $(document).ready(function(){
            zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        });
    </script>
@stop