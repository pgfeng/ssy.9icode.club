<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>自定义表单管理</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin:30px;
        }
        table tr{
            border-bottom: 1px solid #e5e5e5;
        }
        table{
            width: 100%;
        }
        table tr td{
            line-height: 20px;
            margin-bottom: 10px;;
        }
        tr:hover{
            background: #e5e5e5;
        }
        div.form{
        }
        /*
        .row.form-actions.actions-bar{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        */
    </style>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1>管理自定义表单 <small class="label label-important" style="font-size: 12px;">注意：非开发人员请勿更改！</small></h1>
        <hr/>
    </div>
    <div class="form-content">
        <div class="row">
            <div class="span16">
                <div id="grid">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <{php $form=json_encode($form)}>
    BUI.use(['bui/grid','bui/data'],function(Grid,Data){
        var Grid = Grid,
            Store = Data.Store,
            columns = [
                {title : '表单ID',dataIndex:'formid',width:80},
                {title : '表单名称',dataIndex :'formname',width:'100px'}, //editor中的定义等用于 BUI.Form.Field.Text的定义
                {title : '表单参数', dataIndex :'formsetting',width:'600px',editor : {xtype : 'textarea',rules : {required : true}}}
            ],
            data = <{$form}>;

        var editing = new Grid.Plugins.RowEditing(),
            store = new Store({
                data : data,
                autoLoad:true
            }),
            grid = new Grid.Grid({
                render:'#grid',
                columns : columns,
                width : '823px',
                forceFit : false,
                tbar:{ //添加、删除
                    items : [{
                        btnCls : 'button button-inverse',
                        text : '<i class="icon-white icon-plus"></i>添加',
                        listeners : {
                            'click' : addFunction
                        }
                    },
                        {
                            btnCls : 'button button-danger',
                            text : '<i class="icon-white icon-remove"></i>删除',
                            listeners : {
                                'click' : delFunction
                            }
                        }]
                },
                plugins : [editing,Grid.Plugins.CheckSelection],
                store : store
            });
        grid.render();
        //value 是当前编辑的值
        //obj是编辑的所有输入框内容构成的对象
        //origin : 是编辑的记录
        function validFn (value,obj,origin) {
            var records = store.getResult(),
                rst = '';
            BUI.each(records,function (record) {
                if(record.a == value && origin != record){
                    rst = '文本不能重复';
                    return false;
                }
            });
            return rst;
        }
        //添加记录
        function addFunction(){
            location.href='<{url('Form/setting/add')}>';
        }
        //删除选中的记录
        function delFunction(){
            var selections = grid.getSelection(),size=selections.length;
            if(size==0){
                return;
            }
            BUI.Message.Show({
                msg : '确认删除选中的表单么?<p class="auxiliary-text">删除会将表单的所有内容都删除，并不能撤消。</p>',
                icon : 'question',
                buttons : [
                    {
                        text:'确定',
                        elCls : 'button button-danger',
                        handler : function(){
                            var $id = '';
                            for(var i=0;i<size;i++)
                            {
                                if($id=='')
                                {
                                    $id=selections[i]['formid'];
                                }else{
                                    $id+=','+selections[i]['formid'];
                                }
                            }
                            var url = '<{url('Form/setting/del')}>';
                            $.post(url,{
                                'formid':$id
                            },function(data){
                                data=JSON.parse(data);
                                if (data.status == 'true') {
                                    location.href = '<{url('Form/setting')}>';
                                } else {
                                    data.status = 'error';
                                    BUI.Message.Alert(data['msg'], data.status);
                                }
                            });
                            this.close();
                        }
                    },
                    {
                        text:'取消',
                        elCls : 'button',
                        handler : function(){
                            this.close();
                        }
                    }

                ]
            });
            //store.remove(selections);
        }
        editing.on('accept',function () {
            var record = editing.get('record');
            alert(record.formsetting);
            $.post('<{url('Form/setting/edit')}>',{
                'formid':record.formid,
                'formsetting':record.formsetting
            },function(data){
                data = JSON.parse(data);
                if(data.status=='error'){
                    BUI.Message.Alert(data.msg, 'error');
                }else{
                    BUI.Message.Alert(data['msg'], 'success');
                }
            });
            grid.render(record);
        });
    });
</script>
</body>
</html>