<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_数据模型字段管理</title>
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
        <h1>模型管理--<{$module['name']}>模型字段管理</h1>
        <hr>
    </div>
    <div id="grid"></div>
</div>
<script type="text/javascript">
    BUI.use(['bui/grid', 'bui/data'], function (Grid, Data) {

        var columns = [
                {title: '字段名', dataIndex: 'name', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '别名', dataIndex: 'tname', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '类型', dataIndex: 'formtype', editor: {xtype: 'text', rules: {required: true}}, width: 100},
                {title: '索引', dataIndex: 'is_index', editor: {xtype: 'text', rules: {required: true}}, width: 50},
                {title: '为空', dataIndex: 'is_null', editor: {xtype: 'text', rules: {required: true}}, width: 50},
                {
                    title: '操作', renderer: function () {
                    return '<span class="button button-primary btn-manage">修改字段</span>';
                }, width: 100
                }
            ],
        //默认的数据
            data =<{module('admin')->field_list($module['modelid'])}>,
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
                width: 550,
                store: store,
                plugins: [Grid.Plugins.CheckSelection, editing],
                tbar: {
                    items: [{
                        btnCls: 'button button-primary',
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
            window.location.href='<{url('Module/manage/field/add')}>?mid=<{$module.modelid}>';
        }

        editing.on('accept', function (editing) {
            var form = this.get('form'),
                record = form.serializeToObject();
            if (record.moduleid > 0)             //如果存在id则是编辑
            {
                var url = '<{url('Module/manage/field/edit/')}>' + '?' + new Date().getTime();
                $.post(url, {is_category:record.is_category,name: record.modulename, description: record.description, tablename: record.tablename}, function (data) {
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
                var url = '/manage.php/Module/manage/add/' + '?' + new Date().getTime();
                $.post(url, {is_category:record.is_category,moduleid:record.moduleid,name: record.modulename, description: record.description, tablename: record.tablename}, function (data) {
                    //alert(data);
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
                msg : '确认删除选中的字段么么?<p class="auxiliary-text">删除会删除字段下的所有内容，并不能撤消。</p>',
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
                            var url = '<{url('Module/manage/field/del')}>?mid=<{$_GET['mid']}>';
                            $.post(url,{id:$id},function(data){
                                data=JSON.parse(data);
                                if (data.status == 'ok') {
                                    //data.status = 'success';
                                    //BUI.Message.Alert(data['msg'], data.status);
                                    location.href = '<{url('Module/manage/field')}>?mid=<{$_GET['mid']}>';
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
                window.location.href='<{url('Module/manage/field/edit/')}>/?mid=<{$module.modelid}>&fid='+record.id;
            }
            /**
             if (target.hasClass('btn-del')) {
                var url = '/manage.php/Index/admin_manage/del/' + '?' + new Date().getTime();
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