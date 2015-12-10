<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei 角色管理</title>
    <?php view('Index/head'); ?>
</head>
<body>

<div class="row" style="margin-top: 10px">
    <div class="span24 offset1">
        <div style="margin-top:30px;">
            <h1>角色管理</h1>
            <hr>
        </div>
        <div id="role"></div>
    </div>
    <?php $table=array();?>
    <?php if(is_array($role)) foreach($role AS $v) { ?>
    <?php 
        $data['id']=$v['roleid'];
        $data['roleid']=$v['roleid'];
        $data['rolename']=$v['rolename'];
        $data['description']=$v['description'];
        $table[]=$data;
    ?>
    <?php } ?>
    <div id="rolecontent" class="hide">
        <form id="J_Form" class="form-horizontal">
            <input name="roleid" type="hidden" class="input-normal control-text">
            <div class="row">
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>角色名称：</label>
                    <div class="controls">
                        <input name="rolename" type="text" data-rules="{required:true}"
                               class="input-normal control-text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span15">
                    <label class="control-label">备注：</label>
                    <div class="controls control-row4">
                        <textarea name="description" class="input-large" data-rules="{maxlength:255}" type="text"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="roleset" class="hide span1">
        <div class="span9">
            <div id="t1">

            </div>
            <form action="<?php echo url('Index/role/editrole');?>" method="post" id="editrole">
                <input type="hidden" class="menuid" value="" name="menuid"/>
                <input type="hidden" class="roleid" value="" name="roleid"/>
            </form>
        </div>
        <div style="clear: both;"></div>
    </div>
    <script type="text/javascript">
        BUI.use(['bui/grid', 'bui/data'], function (Grid, Data) {
            var columns = [
                    {title: 'ID', dataIndex: 'roleid', width: '50px'},
                    {
                        title: '管理员名称',
                        dataIndex: 'rolename',
                        editor: {xtype: 'text', rules: {required: true}},
                        renderer: Grid.Format.dateRenderer
                    },//使用现有的渲染函数，日期格式化
                    {
                        title: '备注',
                        width: '400',
                        dataIndex: 'description',
                        editor: {xtype: 'text'},
                        renderer: Grid.Format.dateRenderer
                    },
                    {
                        title: '操作', width: '190px', renderer: function () {
                        return '<span class="btn-edit button button-primary">编辑</span>  <span class="btn-update button button-info" id="roleset">权限</span>  <span class="btn-del button button-danger">删除</span>';
                    }
                    }
                ],
            //默认的数据
                data =<?php  echo json_encode($table); ?>,
                store = new Data.Store({
                    data: data
                }),
                editing = new Grid.Plugins.DialogEditing({
                    contentId: 'rolecontent',
                    title:'编辑角色',
                    triggerCls: 'btn-edit'
                }),
                grid = new Grid.Grid({
                    render: '#role',
                    columns: columns,
                    width: '743',
                    //forceFit : true,
                    store: store,
                    plugins: [editing],
                    tbar: {
                        items: [{
                            btnCls: 'button button-inverse',
                            text: '+ 添加角色',
                            listeners: {
                                'click': addFunction
                            }
                        }]
                    }
                });
            grid.render();
            function addFunction() {
                var newData = {rolename: '管理员名称'};
                editing.add(newData); //添加记录后，直接编辑
            }

            editing.on('accept', function (editing) {
                var form = this.get('form'),
                    record = form.serializeToObject();
                if (record.roleid > 0)             //如果存在id则是编辑
                {
                    var url = '<?php echo url('Index/role/edit');?>' + '?' + new Date().getTime();
                    $.post(url, {
                        rolename: record.rolename,
                        description: record.description,
                        roleid: record.roleid
                    }, function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            data.status = 'success';
                        } else {
                            data.status = 'error';
                        }
                        BUI.Message.Alert(data['msg'], data.status);
                    });
                } else {
                    var url = '<?php echo url('Index/role/add');?>' + '?' + new Date().getTime();
                    $.post(url, {rolename: record.rolename, description: record.description}, function (data) {
                        data = JSON.parse(data);
                        top.topManager.reloadPage();
                    });
                }

            });
            var logEl = $('#log');
            $('#btnSave').on('click', function () {

                var records = store.getResult();
                logEl.text(BUI.JSON.stringify(records));
            });
            function updateFunction(roleid) {
                $('.roleid')[0].value = roleid;
                var selections = grid.getSelection();
                BUI.use('bui/tree', function (Tree) {
                    BUI.use('bui/overlay', function (Overlay) {
                        var data =<?php echo module('admin')->treemenu();?>;
                        var tree = new Tree.TreeList({
                            render: '#t1',
                            nodes: data,
                            checkType: 'all', //checkType:勾选模式，提供了4中，all,onlyLeaf,none,custom
                            showLine: true //显示连接线
                        });
                        tree.on('checkedchange', function (ev) {
                            var checkedNodes = tree.getCheckedNodes();
                            var str = '';
                            BUI.each(checkedNodes, function (node) {
                                str += node.id + ',';
                            });
                            $('.menuid')[0].value = str;
                        });
                        var dialog = new Overlay.Dialog({
                            title: '修改角色权限',
                            width: 500,
                            contentId: 'roleset',
                            success: function () {
                                $('#editrole').submit();
                                this.close();
                            },
                            children: [tree],
                            childContainer: '.bui-stdmod-body'
                        });
                        dialog.show();
                        tree.render();
                        $('#btnShow').on('click', function () {
                            dialog.show();
                        });
                    });

                }); //
            }

            grid.on('cellclick', function (ev) {
                var record = ev.record, //点击行的记录
                    field = ev.field, //点击对应列的dataIndex
                    target = $(ev.domTarget); //点击的元素
                if (target.hasClass('btn-update')) {
                    var selections = grid.getSelection();
                    updateFunction(record.roleid);
                }

                if (target.hasClass('btn-del')) {
                    BUI.Message.Show({
                        msg : '确认删除选中的角色么?<p class="auxiliary-text">不能撤销，如果确定删除请点击确定。</p>',
                        icon : 'question',
                        buttons : [
                            {
                                text:'确定',
                                elCls : 'button button-danger',
                                handler : function(){
                                    var url = '<?php echo url('Index/role/del');?>' + '?' + new Date().getTime();
                                    $.post(url, 'roleid=' + record.roleid, function (data) {
                                        data = JSON.parse(data);
                                        if (data.status == true) {
                                            data.status = 'success';
                                            store.remove(record);
                                        } else {
                                            data.status = 'error';
                                        }
                                        BUI.Message.Alert(data['msg'], data.status);
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
                }

            });
        });
    </script>
</body>
</html>