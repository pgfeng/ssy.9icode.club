<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_数据模型管理</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin-left: 30px;margin-top:30px;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1>模型管理</h1>
        <hr>
    </div>
    <div id="grid"></div>
</div>
<div id="content" class="hide">
    <form id="J_Form" class="form-horizontal">
        <input type="hidden" name="id" value="0" id="moduleid"/>

        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>模型类型：</label>
                <div class="controls">
                    <select name="is_category" class="input-normal control-text" style="height: auto;">
                        <option value="0"> 内容模型 </option>
                        <option value="1"> 栏目模型 </option>
                        <option value="2"> 单页面模型 </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>模型名称：</label>
                <div class="controls">
                    <input name="modulename" type="text" data-rules="{required:true}" class="input-normal control-text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span15 ">
                <label class="control-label"><s>*</s>模型表名：</label>
                <div class="controls">
                    <input name="tablename" type="text" data-rules="{required:true}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span15">
                <label class="control-label">备注：</label>
                <div class="controls control-row4">
                    <textarea name="description" class="input-large" type="text"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
//print_r($module);
$data = array();
foreach ($module as $md) {
    $data[] = array(
        'id' => $md['modelid'],
        'name' => $md['name'],
        'description' => $md['description'],
        'tablename' => $md['tablename'],
        'disabled' => $md['disabled'],
        'is_category'=>$md['is_category'],
        'is_page'=>$md['is_page']
    );
}
$data = json_encode($data);
?>
<script type="text/javascript">
    BUI.use(['bui/grid', 'bui/data'], function (Grid, Data) {

        var columns = [
                {title: '模型ID', dataIndex: 'id', editor: {xtype: 'text', rules: {required: true}}, width: 80},
                {title: '模型名称', dataIndex: 'name', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '模型表名', dataIndex: 'tablename', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '是否为栏目', dataIndex: 'is_category', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '是否为单页面', dataIndex: 'is_page', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '模型介绍', dataIndex: 'description', editor: {xtype: 'textarea'}, width: 250},
                {
                    title: '操作', renderer: function () {
                    return '<span class="button button-info btn-manage">字段管理</span>';
                }, width: 100
                }
            ],
        //默认的数据
            data =<{$data}>,
        store = new Data.Store({
            data: data
        }),
            editing = new Grid.Plugins.DialogEditing({
                contentId: 'content',
                triggerCls: 'btn-edit'
            }),
            grid = new Grid.Grid({
                render: '#grid',
                columns: columns,
                width: 890,
                store: store,
                plugins: [Grid.Plugins.CheckSelection, editing],
                tbar: {
                    items: [{
                        btnCls: 'button button-inverse',
                        text: '<i class="icon-white icon-plus"></i>  添加',
                        listeners: {
                            'click': addFunction
                        }
                    },
                        {
                            btnCls: 'button button-danger',
                            text: '<i class="icon-white icon-remove"></i>  删除',
                            listeners: {
                                'click': delFunction
                            }
                        }]
                }
            });
        grid.render();

        function addFunction() {
            var newData = {name: '请输入模型名称'};
            editing.edit(newData, 'add'); //添加记录后，直接编辑
        }

        editing.on('accept', function (editing) {
            var form = this.get('form'),
                record = form.serializeToObject();
            if (record.id > 0)             //如果存在id则是编辑
            {
                var url = '<{url('Module/manage/edit')}>' + '?' + new Date().getTime();
                $.post(url, {mid:record.id,is_category:record.is_category,name: record.modulename, description: record.description, tablename: record.tablename}, function (data) {
                    //alert(data);
                    data = JSON.parse(data);
                    if (data.status == true) {
                        data.status = 'success';
                    } else {
                        data.status = 'error';
                    }
                    BUI.Message.Alert(data['msg'], data.status);
                });
            } else {
                var url = '<{url('Module/manage/add')}>' + '?' + new Date().getTime();
                $.post(url, {is_category:record.is_category,moduleid:record.moduleid,name: record.modulename, description: record.description, tablename: record.tablename}, function (data) {
                    data = JSON.parse(data);
                    if (data.status == true) {
                        data.status = 'success';
                        BUI.Message.Alert(data['msg'], data.status);
                        top.topManager.reloadPage();
                    } else {
                        data.status = 'error';
                        BUI.Message.Alert(data['msg'], data.status);
                    }
                });
            }

        });
        function delFunction() {
                BUI.Message.Show({
                    msg : '确认删除选中的模型么?<p class="auxiliary-text">删除会删除模型下的所有内容，并不能撤消。</p>',
                    icon : 'question',
                    buttons : [
                        {
                            text:'确定',
                            elCls : 'button button-danger',
                            handler : function(){
                                var selections = grid.getSelection(),size=selections.length;
                                $id='';
                                for(var i=0;i<size;i++)
                                {
                                    if($id=='')
                                    {
                                        $id=selections[i].id;
                                    }else{
                                        $id+=','+selections[i].id;
                                    }
                                }
                                BUI.Message.Alert('你选取的模型ID是'+$id,'error');
                                var url = '<{url('Module/manage/del')}>';
                                $.post(url,{id:$id},function(data){
                                    data=JSON.parse(data);
                                    //alert(data);
                                    if (data.status == true) {
                                        data.status = 'success';
                                        BUI.Message.Alert(data['msg'], data.status);
                                        top.topManager.reloadPage();
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
                //store.remove(selections[i]);
        }

        grid.on('cellclick', function (ev) {
            var record = ev.record, //点击行的记录
                field = ev.field, //点击对应列的dataIndex
                target = $(ev.domTarget); //点击的元素
            if (target.hasClass('btn-manage')) {
                var selections = grid.getSelection();
                window.location.href='<{url('Module/manage/field')}>?mid='+record.id;
            }
            /**
            if (target.hasClass('btn-del')) {
                var url = '<{url('Index/admin_manage/del')}>' + '?' + new Date().getTime();
                $.post(url, 'userid=' + record.userid, function (data) {
                    data = JSON.parse(data);
                    if (data.status == true) {
                        data.status = 'success';
                        store.remove(record);
                    } else {
                        data.status = 'error';
                    }
                    BUI.Message.Alert(data['msg'], data.status);
                });
            }
             **/

        });
    });
</script>
<!-- script end -->
</body>
</html>