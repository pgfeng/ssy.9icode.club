<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_选择单页面模型</title>
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
            float: right;
            width:50%;
        }

        .form-horizontal .controls{
            height:25px;
        }
        /*
        .row.form-actions.actions-bar{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        */
    </style>

    <script>
        window.alert=BUI.Message.Alert;
    </script>
</head>
<body>
<div class="wrap">
    <div id="content" class="hidden">
        <form id="form" class="form-horizontal">
            <div class="row" style="">
                <div class="control-group span8">
                    <label class="control-label">选择一个模型：</label>
                    <div class="controls">
                        <select class="input-normal" id="chose">
                            <{loop $model $p}>
                            <option value="<{$p.modelid}>"><{$p.name}></option>
                            <{/loop}>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        BUI.use(['bui/overlay','bui/form'],function(Overlay,Form){

            var form = new Form.HForm({
                srcNode : '#form'
            }).render();

            var dialog = new Overlay.Dialog({
                title:'请选择一个单页面模型',
                width:500,
                height:150,
                //配置DOM容器的编号
                contentId:'content',
                buttons:[
                    {
                        text:'选择单页面模型',
                        elCls : 'button-large button-primary',
                        handler : function(){
                            location.href = '<{url('Content/page/add')}>?parent='+<{if isset($_REQUEST['parent'])}>'<{$_REQUEST['parent']}>'<{else}>'0'<{/if}>+'&mid='+$('#chose').val();
                        }
                    }],
                success:function () {
                    alert('确认');
                    this.close();
                },
                cancel:function(){
                    alert('不选择单页面模型，没法添加单页面哦~');
                    return false;
                }
            });
            dialog.show();
            $('#btnShow').on('click',function () {
                dialog.show();
            });
        });
    </script>
</div>
</body>
</html>
<php>
    exit;
</php>