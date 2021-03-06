<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_管理栏目</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin:30px;
        }
        .form-horizontal .controls{
            height:25px;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1>栏目管理</h1>
        <hr>
    </div>
    <table class="table ">
        <thead>
        <tr>
            <th width="80">排序</th>
            <th width="80">栏目ID</th>
            <th>名称</th>
            <th width="100">模型表</th>
            <th width="100">类型</th>
            <th width="350">操作</th>
        </tr>
        </thead>
        <tbody>
        <{loop $category $cate}>
        <tr>
            <td><input type="number" value="<{$cate['listorder']}>" style="width: 40px;" cid="<{$cate['cid']}>" class="listorder" title="值越小越靠前"/></td>
            <td><{$cate['cid']}></td>
            <td><a href="<{url('Content/content/manage',array('cid'=>$cate['cid']))}>" title="点击进入内容管理"><{$cate['realcatname']}></a></td>
            <td><{$cate['catetable']}></td>
            <td><{if $cate['is_page']==1}>单网页<{else}>栏目<{/if}></td>
            <td>
                <{if $cate['is_page']==0}>
                    <a href="<{url('Content/category/edit',array('cid'=>$cate['cid']))}>">编辑此栏目</a>
                <{else}>
                    <a href="<{url('Content/page/edit',array('cid'=>$cate['cid']))}>">编辑此单网页</a>
                <{/if}>
                <{if $cate['is_page']==0}>
                | <a href="<{url('Content/category/add',array('parent'=>$cate['cid'],'mid'=>$cate['cat_modelid'],'cmid'=>$cate['con_modelid']))}>">添加子栏目</a>
                <{/if}>
                <{if $cate['is_page']==0}>
                | <a href="javascript:;" class="delcat" cid="<{$cate['cid']}>">删除栏目</a>
                <{else}>
                | <a href="javascript:;" class="delcat" cid="<{$cate['cid']}>">删除此单网页</a>
                <{/if}>
                <{if $cate['is_page']==0}>
                | <a href="<{url('Content/content/add',array('cid'=>$cate['cid']))}>" cid="<{$cate['cid']}>">添加内容</a>
                <{/if}>
                <{if $cate['is_page']==0}>
                | <a href="<{url('Content/page/add',array('parent'=>$cate['cid']))}>" cid="<{$cate['cid']}>">添加单网页</a>
                <{/if}>
            </td>
        </tr>
        <{/loop}>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        var listorder=$('.listorder');
        listorder.change(function(){
            //alert($(this).attr('cid'));
            var url='<{url('Content/category/editListorder')}>';
            $.post(url,{
                'cid':$(this).attr('cid'),
                'listorder':$(this).val()
            },function(data){
                location.reload();
            });
        });
        var delcat=$('.delcat');
        delcat.click(function(){
            var cid=$(this).attr('cid');
            BUI.Message.Show({
                msg : '确认删除选中的栏目或单网页么?<p class="auxiliary-text">会删除栏目下的所有内容，并不能撤消。</p>',
                icon : 'question',
                buttons : [
                    {
                        text:'确定',
                        elCls : 'button button-danger',
                        handler : function(){
                            var url='<{url('Content/Category/del')}>';
                            $.post(url,{
                                'cid':cid
                            },function(data){
                                data=JSON.parse(data);
                                if(data.status==true){
                                    location.reload();
                                }else{
                                    alert(data['msg']);
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