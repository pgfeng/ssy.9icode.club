<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_管理栏目</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin:30px;
        }
        table tr{
            border-bottom: 1px solid #e5e5e5;line-height: 35px;
        }
        table{
            width: 100%;min-width: 1080px;
        }
        table tr td{
            line-height: 20px;text-align: center;
            margin-bottom: 10px;height: 35px;
        }
        table tbody tr:hover{
            background: #c2ccd1;
        }
        table tr td:nth-of-type(3){
            text-align: left;
        }
        .form-horizontal .controls{
            height:25px;
        }
        table tr td {
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
    <script>
        $(document).ready(function () {
            $('#choseid').click()
        });
    </script>
    <script>
        window.alert=BUI.Message.Alert;
    </script>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1><{$catname}>-内容管理<a href="<{url('Content/category/manage',array('cid'=>$cid))}>" class="button button-small right">返回列表</a></h1>
        <hr>
    </div>
    <div class="rows">
    <div style="margin-top: 20px;">

        <a href="javascript:;" class="button button-danger" id="batchDelete"><i class="icon-white icon-trash"></i>  批量删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<{url('Content/content/add',array('cid'=>$cid))}>" class="button button-inverse"><i class="icon-white icon-plus"></i>  添加内容</a>
    </div>
    <table class="table" id="content">
        <thead>
        <tr>
            <th width="50"><input type="checkbox" id="choseC"/></th>
            <th width="50">排序</th>
            <th width="50">ID</th>
            <th>标题</th>
            <th width="50">点击量</th>
            <th width="145">发布时间</th>
            <th width="145">更新时间</th>
            <th width="155">模板文件</th>
            <th width="155">管理操作</th>
        </tr>
        </thead>
        <tbody>
        <{loop $content $con}>
        <tr>
            <td><input type="checkbox" name="choseid" class="chose" aid="<{$con['id']}>" cid="<{$cid}>"/></td>
            <td><input type="number" value="<{$con['listorder']}>" style="width: 40px;" id="<{$con['id']}>" cid="<{$cid}>" class="listorder" title="值越大越靠前，和栏目相反"/></td>
            <td><{$con['id']}></td>
            <td><a href="<{url('Content/content/edit',array('cid'=>$_GET['cid'],'id'=>$con['id']))}>" title="进入编辑"><{$con['title']}></a></td>
            <td><{$con['hits']}></td>
            <td><{date("Y-m-d H:i:s",$con['inputtime'])}></td>
            <td><{date("Y-m-d H:i:s",$con['updatetime'])}></td>
            <td><{$con['template']}></td>
            <td><a href="<{url('Content/content/edit',array('cid'=>$_GET['cid'],'id'=>$con['id']))}>" class="button button-primary"><i class="icon-white icon-edit"></i>  编辑</a>  <a class="del button button-danger" id="<{$con['id']}>" cid="<{$cid}>" href="javascript:;"><i class="icon-white icon-remove"></i>删除</a></td>
        </tr>
        <{/loop}>
        </tbody>
    </table>
    <div style="text-align: center;">
        <{$pages}>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#choseC').click(function(){
            if($(this).attr('checked')=='checked'){
                $("[name = choseid]:checkbox").attr("checked", true);
            }else{
                $("[name = choseid]:checkbox").attr("checked", false);
            }
        });
        var listorder=$('.listorder');
        listorder.change(function(){
            //alert($(this).attr('cid'));
            var url='<{url('Content/content/editListorder')}>';
            $.post(url,{
                'cid':$(this).attr('cid'),
                'id':$(this).attr('id'),
                'listorder':$(this).val()
            },function(data){
                location.href='<{url('Content/content/manage',array('cid'=>$cid))}>';
            });
        });
        var delcat=$('.del'),batchDelete=$('#batchDelete');
        batchDelete.click(function () {
            var cid=<{$cid}>,id='';
            $("[name = choseid]:checkbox").each(function(){
                if($(this).attr('checked')=='checked'){
                    if(id!='')
                    {
                       id+=','+$(this).attr('aid');
                    }else{
                        id = $(this).attr('aid');
                    }
                }
            });
            BUI.Message.Show({
                msg : '确认删除选中的内容么?<p class="auxiliary-text">删除后将不可以撤销。</p>',
                icon : 'question',
                buttons : [
                    {
                        text:'确定',
                        elCls : 'button button-danger',
                        handler : function(){
                            var url='<{url('Content/content/del')}>';
                            $.post(url,{
                                'cid':cid,
                                'id':id
                            },function(data){
                                data = JSON.parse(data);
                                if(data.status==true){
                                    location.href='<{url('Content/content/manage',array('cid'=>$cid))}>';
                                }else{
                                    alert(data.msg,'error');
                                }
                            });
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
        delcat.click(function(){
            var cid=$(this).attr('cid'),id=$(this).attr('id');
            BUI.Message.Show({
                msg : '确认删除这条的内容么?<p class="auxiliary-text">删除后将不可以撤销。</p>',
                icon : 'question',
                buttons : [
                    {
                        text:'确定',
                        elCls : 'button button-danger',
                        handler : function(){
                            var url='<{url('Content/content/del')}>';
                            $.post(url,{
                                'cid':cid,
                                'id':id
                            },function(data){
                                data = JSON.parse(data);
                                if(data.status==true){
                                    location.href='<{url('Content/content/manage',array('cid'=>$cid))}>';
                                }else{
                                    alert(data.msg);
                                }
                            });
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

    });
</script>
</body>
</html>