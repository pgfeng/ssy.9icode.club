<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei 用户管理</title>
    <{template 'Index/head'}>
</head>
<body>
<div class="row" style="margin-top: 10px">
    <div class="span24 offset1">
        <div style="margin-top:30px;">
            <h1>用户管理</h1>
            <hr>
        </div>
        <div id="member"></div>
    </div>
    <body>
    <div class="demo-content">
        <h2>换行</h2>
        <div id="s1">
            <input type="hidden" id="hide" value="选项二" name="hide">
        </div>
        <h2>在一行中</h2>
        <div id="s2">
            <input type="hidden" id="hide1" value="2,3" name="hide1">
        </div>



        <!-- script start -->
        <script type="text/javascript">
            BUI.use('bui/select',function(Select){
                var items1 = [
                        '1','2','3','4'
                    ],
                    select1 = new Select.Combox({
                        render: '#s2',
                        showTag: true,
                        separator: ',',
                        width: 500,
                        elCls: 'bui-tag-follow',
                        valueField: '#hide1',//显示tag的Combox必须存在valueField
                        items: items1
                    });
                select1.render();
                var hide1=$('#hide1').val();
            });

        </script>
        <!-- script end -->
    </div>
    </body>
</div>