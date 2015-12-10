<!DOCTYPE HTML>
<head>
    <title>添加自定义表单</title>
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
        div.form{
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
            <h1>添加自定义表单 <small class="label label-important" style="font-size:8px;"> 如果添加完成后请不要更改</small></h1>
            <hr/>
        </div>
        <div class="form">
            <form id="J_Form" action="<{url('Form/setting/add')}>" class="form-horizontal" method="post">
                <div class="row">
                <div class="control-group">
                    <label class="control-label"><s>*</s>表单名称：</label>
                    <div class="controls">
                        <input type="text" class="control-row1 input-large" name="formname" data-rules="{required : true}" placeholder="表单名称"/>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="control-group">
                        <label class="control-label" class="tip"><s>*</s>配置参数：</label>
                        <div class="controls control-row-auto">
                            <textarea class="control-row4 input-large tip" name="formsetting" data-rules="{required : true}" placeholder="表单参数配置"/></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-actions span13 offset3">
                        <input type="submit" class="button button-primary" name="add_form" value="添加表单">
                        <button type="reset" class="button">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        BUI.use('bui/form',function(Form){

            new Form.Form({
                srcNode : '#J_Form'
            }).render();
            BUI.use('bui/tooltip',function (Tooltip) {
                var tip = new Tooltip.Tip({
                    trigger: '.tip',
                    alignType: 'bottom',
                    offset: 10,
                    title: '配置格式如：标题,内容,姓名,简介<br/>实例：中间以英文逗号！',
                    elCls: 'tips tips-warning',
                    titleTpl: '<span class="x-icon x-icon-small x-icon-error"><i class="icon icon-white icon-bell"></i></span>\
                <div class="tips-content">{title}</div>'
                });
                tip.render();
            });
        });

    </script>
</body>
</html>