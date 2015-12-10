<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_<{$category['catname']}>-<{if $action=='edit'}>修改<{else}>添加<{/if}>内容</title>
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
        table tr td:nth-of-type(1){
            float: left;
            width:50%;
        }

        .form-horizontal .controls{
            height:25px;margin-left: 0;
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
        <h1><{$category['catname']}>-<{if $action=='edit'}>修改<{else}>添加<{/if}>内容<a href="<{url('Content/category/manage')}>" class="button button-small right">返回列表</a></h1>
        <hr>
    </div>
        <form action="<{url('Content/content/'.$action)}>" class="form-horizontal" id="form" method="post">
            <{php module('form')->fieldtoform($field,$type,0,$_GET['cid'],$action,$id);}>
            <input type="hidden" value="<{$_GET['cid']}>" name="cid"/>
            <input type="hidden" value="<{$category['con_modelid']}>" name="mid"/>
            <{if $action=='edit'}>
                <input type="hidden" value="<{$_GET['id']}>" name="id"/>
            <{/if}>
            <div class="row form-actions actions-bar">
                <div class="span13 offset6 ">
                    <input type="submit" class="button button-primary bui-form-field" name="<{$action}>_content" value="提交" id="submit" aria-disabled="false" aria-pressed="false">
                    <button type="reset" class="button offset1">重新设置</button>
                </div>
            </div>
        </form>

    <style>
        textarea{
            margin: 4px 0;
        }
    </style>
        <script>
            $('#form').ready(function() {
                var reheight = $('input,textarea');
                for (var i = 0; i < reheight.size(); i++) {
                    $(reheight[i]).parent().parent().css({
                        'height': $(reheight[i]).height() + 18,
                        'line-height': $(reheight[i]).height() + 18 + 'px'
                    });
                }
                $('ul.piclist').ready(function(){
                    var piclist = $('ul.piclist');
                    for (var i = 0; i < piclist.length; i++) {
                        var liN = $(piclist[i]).find('li').size();
                        $(piclist[i]).height(liN*30)
                    }
                });
            });
        </script>
    </div>
    <script>
        BUI.use('bui/form',function(Form){
            new Form.Form({
                srcNode : '#form'
            }).render();
        });
    </script>
</body>
</html>