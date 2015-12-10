<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei 用户组管理</title>
    <?php view('Index/head'); ?>
</head>
<body>
<div class="row" style="margin-top: 10px">
    <div class="span24 offset1">
        <div style="margin-top:30px;">
            <h1>用户组管理</h1>
            <hr>
        </div>
        <div id="role"></div>
    </div>
    <div id="rolecontent" class="hide">
        <form id="J_Form" class="form-horizontal">
            <input name="groupid" type="hidden" class="input-normal control-text">
            <div class="row">
                <div class="control-group span8">
                    <label class="control-label"><s>*</s>用户组名：</label>
                    <div class="controls">
                        <input name="groupname" type="text" data-rules="{required:true}"
                               class="input-normal control-text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span15">
                    <label class="control-label">用户组描述：</label>
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
                <input type="hidden" class="groupid" value="" name="groupid"/>
            </form>
        </div>
        <div style="clear: both;"></div>
    </div>
    <script type="text/javascript">
        BUI.use(['bui/grid', 'bui/data'], function (Grid, Data) {
            var columns = [
                    {title: 'ID', dataIndex: 'groupid', width: '50px'},
                    {
                        title: '用户组名称',
                        dataIndex: 'groupname',
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
                        title: '操作', width: '140px', renderer: function () {
                            return '<span class="btn-edit button button-primary">编辑</span> <span class="btn-del button button-danger">删除</span>';
                        }
                    }
                ],
            //默认的数据
                data =<?php  echo json_encode($group); ?>,
                store = new Data.Store({
                    data: data
                }),
                editing = new Grid.Plugins.DialogEditing({
                    contentId: 'rolecontent',
                    title:'编辑用户组',
                    triggerCls: 'btn-edit'
                }),
                grid = new Grid.Grid({
                    render: '#role',
                    columns: columns,
                    width: '700',
                    //forceFit : true,
                    store: store,
                    plugins: [editing],
                    tbar: {
                        items: [{
                            btnCls: 'button button-inverse',
                            text: '+ 添加用户组',
                            listeners: {
                                'click': addFunction
                            }
                        }]
                    }
                });
            grid.render();
            function addFunction() {
                var newData = {groupname: '用户组名称'};
                editing.add(newData); //添加记录后，直接编辑
            }

            editing.on('accept', function (editing) {
                var form = this.get('form'),
                    record = form.serializeToObject();
                if (record.groupid > 0)             //如果存在id则是编辑
                {
                    var url = '<?php echo url('Member/group/edit');?>' + '?' + new Date().getTime();
                    $.post(url, {
                        groupname: record.groupname,
                        description: record.description,
                        groupid: record.groupid
                    }, function (data) {
                        data = JSON.parse(data);
                        BUI.Message.Alert(data['msg'], data.status);
                    });
                } else {
                    var url = '<?php echo url('Member/group/add');?>' + '?' + new Date().getTime();
                    $.post(url, {groupname: record.groupname, description: record.description}, function (data) {
                        data = JSON.parse(data);
                        BUI.Message.Alert(data['msg'],function(){
                            location.reload();
                        } , data.status);
                    });
                }
            });

            var logEl = $('#log');
            $('#btnSave').on('click', function () {

                var records = store.getResult();
                logEl.text(BUI.JSON.stringify(records));
            });

            grid.on('cellclick', function (ev) {
                var record = ev.record, //点击行的记录
                    field = ev.field, //点击对应列的dataIndex
                    target = $(ev.domTarget); //点击的元素
                if (target.hasClass('btn-update')) {
                    var selections = grid.getSelection();
                    updateFunction(record.groupid);
                }

                if (target.hasClass('btn-del')) {
                    BUI.Message.Show({
                        msg : '确认删除选中的用户组么?<p class="auxiliary-text">不能撤销，如果确定删除请点击确定。</p>',
                        icon : 'question',
                        buttons : [
                            {
                                text:'确定',
                                elCls : 'button button-danger',
                                handler : function(){
                                    var url = '<?php echo url('Member/group/del');?>' + '?' + new Date().getTime();
                                    $.post(url, 'groupid=' + record.groupid, function (data) {
                                        //alert(data);
                                        data = JSON.parse(data);
                                        if (data.status == true) {
                                            data.status = 'success';
                                            store.remove(record);
                                        } else {
                                            data.status = 'error';
                                        }
                                        BUI.Message.Alert(data['msg'],function(){
                                            location.reload();
                                        }, data.status);
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