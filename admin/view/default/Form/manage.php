<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_<{$name}>管理</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin:30px;
        }
        table tr{
            border-bottom: 1px solid #e5e5e5;line-height: 35px;
        }
        table{
            width: 100%;min-width: 750px;
        }
        table tr td{
            line-height: 20px;text-align: center;
            margin-bottom: 10px;height: 35px;
        }
        table tbody tr:hover{
            background: #c2ccd1;
        }
        table tr td:nth-of-type(1){
            text-align: left;
        }
        .form-horizontal .controls{
            height:25px;
        }
        table tr td {
            line-height: 20px;
            text-align: center;
            margin-bottom: 10px;
            height: 35px;
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1><{$name}></h1>
        <hr>
    </div>
    <table>
        <thead>
        <tr>
            <th align="left" style="padding-left: 20px;"><{$formField[0]}></th>
            <th width="150" align="center">IP地址</th>
            <th width="200">提交时间</th>
            <th width="100" align="center">操作</th>
        </tr>
        </thead>
        <tbody>
        <{loop $fcontent $con}>
        <tr>
            <th  align="left" style="padding-left: 20px;"><a href="<{URL('Form/manage/show/'.$con['id'])}>"><{$con[$formField[0]]}></a></th>
            <th  align="center"><{$con['ip']}></th>
            <th  align="center"><{$con['time']}></th>
            <td align="center" style="padding-left:20px;"><a href="<{URL('Form/manage/show/'.$con['id'])}>">查看</a> | <a class="del" fid="<{$con['id']}>" href="javascript:;">删除</a></td>
        </tr>
        <{/loop}>
        </tbody>
    </table>
    <div style="text-align: center;">
        <{$pages}>
    </div>
</div>
<script>
    $('.del').click(function(event) {
        var id = $(this).attr('fid');
            BUI.Message.Show({
                msg : '确认删除选中的内容么?<p class="auxiliary-text">删除后将不可以撤销。</p>',
                icon : 'question',
                buttons : [
                    {
                        text:'确定',
                        elCls : 'button button-danger',
                        handler : function(){
                            var url='<{url('Form/manage/del')}>';
                            $.post(url,{
                                'id':id,
                                'is_ajax':true
                            },function(data){
                                data = JSON.parse(data);
                                if(data.status=='true'){
                                    location.href='<{url('Form/manage',array('formid'=>$fid))}>';
                                }else{
                                    alert(data.msg);
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
    });
</script>
<!-- script end -->
</body>
</html>