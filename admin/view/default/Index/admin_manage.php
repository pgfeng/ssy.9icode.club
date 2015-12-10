<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> GouWanMei 管理员管理</title>
    <{template 'Index/head'}>
</head>
<body>
<div class="row" style="margin-top: 10px">
    <div class="span24 offset1">
        <div style="margin-top:30px;">
            <h1>管理员管理</h1>
            <hr>
        </div>
        <div id="admin"></div>

    </div>
</div>
<php>$table=array();</php>
<{loop $admin $v}>
<php>
    $data['id']=$v['roleid'];
    $data['roleid']=$v['roleid'];
    $data['userid']=$v['userid'];
    $data['username']=$v['username'];
    $data['rolename']=$v['rolename'];
    $data['realname']=$v['realname'];
    $data['lastloginip']=$v['lastloginip'];
    $data['email']=$v['email'];
    $data['lastlogintime']=date('Y-d-m H:i:s',$v['lastlogintime']);
    $data['description']=$v['description'];
    $table[]=$data;
</php>
<{/loop}>
<div id="content" class="hide">
    <form id="J_Form" class="form-horizontal">
        <input name="userid" type="hidden" class="input-normal control-text">

        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>用户名：</label>

                <div class="controls">
                    <input name="username" type="text" data-rules="{required:true}" value=""
                           class="input-normal control-text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>昵称：</label>
                <div class="controls">
                    <input name="realname" type="text" data-rules="{required:true}" value=""
                           class="input-normal control-text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>密码：</label>

                <div class="controls">
                    <input name="password" type="text" data-rules="{required:true}"
                           class="input-normal control-text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>邮箱：</label>

                <div class="controls">
                    <input name="email" type="text" data-rules="{required:true,email:true}" value=""
                           class="input-normal control-text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="control-group span8">
                <label class="control-label"><s>*</s>所属角色：</label>
                <div class="controls">
                    <select name="roleid" class="input-normal">
                        <php>$roledata=array();</php>
                        <{loop $role $v}>
                        <php>
                            $roledata[$v['roleid']]=$v['rolename'];
                        </php>
                        <option value="<{$v['roleid']}>"><{$v['rolename']}></option>
                        <{/loop}>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $roledata = json_encode($roledata); ?>
<script type="text/javascript">
    BUI.use(['bui/grid', 'bui/data'], function (Grid, Data) {
        var data =
        <{php echo json_encode($table);}>,
            store = new Data.Store({
                data: data
            }),
                enumObj =<{$roledata}>,
        columns = [
            {title: 'ID', dataIndex: 'userid', width: '60px'},
            {title: '用户名', dataIndex: 'username', editor: {xtype: 'text'}},
            {title: '昵称', dataIndex: 'realname', editor: {xtype: 'text'}},
            {title: '所属角色', dataIndex: 'roleid', renderer: Grid.Format.enumRenderer(enumObj)},
            {title: '最后登录IP', dataIndex: 'lastloginip'},
            {title: '最后登录时间', dataIndex: 'lastlogintime', width: '150'},
            {
                title: 'email',
                dataIndex: 'email',
                editor: {xtype: 'text'},
                renderer: Grid.Format.dateRenderer,
                width: '200'
            },
            {
                title: '操作', width: '130', renderer: function () {
                return '<span class="button button-primary btn-edit">编辑</span> <span class="button button-danger btn-del">删除</span>';
            }
            }
        ],
            //默认的数据
            editing = new Grid.Plugins.DialogEditing({
                contentId: 'content',
                triggerCls: 'btn-edit'
            }),
            grid = new Grid.Grid({
                render: '#admin',
                columns: columns,
                width: '950',
                //forceFit : true,
                store: store,
                plugins: [editing],
                tbar: {
                    items: [{
                        btnCls: 'button button-inverse',
                        text: '+ 添加管理员',
                        listeners: {
                            'click': addFunction
                        }
                    }]
                }
            });
        grid.render();
        function addFunction() {
            var newData = {username: '管理员用户名'};
            editing.add(newData); //添加记录后，直接编辑
        }
        editing.on('accept', function (editing) {
            var form = this.get('form'),
                record = form.serializeToObject();
            if (record.userid > 0) {
                var url = '<{url('Index/admin_manage/edit')}>' + '?' + new Date().getTime();
                $.post(url, {
                    userid: record.userid,
                    roleid: record.roleid,
                    username: record.username,
                    realname: record.realname,
                    email: record.email,
                    password: record.password
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
                var url = '<{url('Index/admin_manage/add')}>' + '?' + new Date().getTime();
                $.post(url, {
                    userid: record.userid,
                    roleid: record.roleid,
                    username: record.username,
                    realname: record.realname,
                    email: record.email,
                    password: record.password
                }, function (data) {
                    data = JSON.parse(data);
                    top.topManager.reloadPage();
                });
            }
        });
        var logEl = $('#log');
        grid.on('cellclick', function (ev) {
            var record = ev.record, //点击行的记录
                field = ev.field, //点击对应列的dataIndex
                target = $(ev.domTarget); //点击的元素
            if (target.hasClass('btn-update')) {
                var selections = grid.getSelection();
            }
            if (target.hasClass('btn-del')) {

                BUI.Message.Show({
                    msg : '确认删除选中的管理员么?<p class="auxiliary-text">不能撤销，如果确定删除请点击确定。</p>',
                    icon : 'question',
                    buttons : [
                        {
                            text:'确定',
                            elCls : 'button button-danger',
                            handler : function(){
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