<?php
$data = array(
    'rows'   =>  array(
        array('id'=>1,'username'=>'lvyahui','email'=>'devlyh@163.com','phone'=>'9999','group'=>'组1','group_id'=>1),
        array('id'=>2,'username'=>'lvyahui','email'=>'lvyahui8@126.com','phone'=>'9999','group'=>'组2','group_id'=>2),
        array('id'=>3,'username'=>'lvyahui','email'=>'samlv@tencent.com','phone'=>'9999','group'=>'组1','group_id'=>1),
        array('id'=>4,'username'=>'lvyahui','email'=>'1257069082@qq.com','phone'=>'9999','group'=>'组3','group_id'=>3),
    )
);
?>
<h1>注意看chrome network面板发出的请求，后台现在只是响应假数据</h1>
<p>
    支持类似Excel的表格编辑功能，比如多行复制，下拉拖拽复制等等
</p>
<pre>
    public function postTableRow(){
        $data = Input::all();
        $data['id'] = rand(1,1000);
        return Response::json($data);
    }

    public function getTableDelete(){
        return Response::json(Input::get('id'));
    }
</pre>
<div id="dataTable">
</div>
{{HTML::script('js/handsontable.full.min.js')}}
{{HTML::style('css/handsontable.full.min.css')}}
{{HTML::script('js/editTable.js')}}
<script>
    var $ = $ || jQuery;
    $(document).ready(function(){
        $('#dataTable').initEdit({
            rows    :  JSON.parse('<?=json_encode($data['rows'])?>'),
            colHeaders :   ['ID','用户名','邮箱','电话号码'],
            columns :   {
                id  :   {
                    readOnly    :   true
                },
                username : {
                    label   :   '用户名',
                    required    :   true,
                    validator  :    /^\w+$/
                },
                email :{
                    required    :   true,
                    //validator  :    /^\w+$/
                    editor: 'select',
                    selectOptions : ['lvyahui8@126.com','devlyh@163.com']
                },
                phone :{
                    validator  :    function(value,callback){
                        //return value.length > 1;
                        callback(true);
                        return true;
                    },
                    allowVaild  :   true
                },
                group  :    {
                    required    :   true,
                    editor: 'select',
                    selectOptions : ['组1','组2','组3']
                }
            },

            bindData    :   {
                cus :   1,
                category_id :   2
            },

            beforeSave  :   function(data){
                var groups = [{name:'组1',id:1},{name:'组2',id:2},{name:'组3',id:3}];
                var has = groups.filter(function(item){
                    if(item.name == data.group){
                        return true;
                    }else{
                        return false;
                    }
                });
                if(has.length > 0){
                    data.group_id = has[0].id;
                }
                return data;
            },

            afterSave   :   function(resp){

            },

            url         :   {
                save    :   '<?=URL::to('test/table-row')?>',
                delete  :   '<?=URL::to('test/table-delete')?>'
            }
        });
        $('body').trigger('add.dataTable',{
            id  :   111,
            username    :   'keensoft_lvyahui',
            email   :   'lvyahui@keensoft.net',
            phone   :   '100000',
            gourp_id    :   1
        });
    });
</script>

