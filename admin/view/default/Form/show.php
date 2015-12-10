<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_<{$name}>查看表单</title>
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
        .tr > .name{
                font-size: 18px;
                font-weight: 700;
                float: left;
        }
        .tr{
            height: 50px;
        }
        .tr > .con{
            float: left;
            font-size: 16px;
            width: 500px;
            margin-left: 20px;
        }
        .show{
            width: 800px;margin: 0 auto;padding-top: 50px;
        }
        .left{
            float: left;
        }
        .right{
            float: right;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="nav">
        <h1><{$name}>-查看表单</h1>
        <hr>
    </div>
    <div class="show">
    <{loop $form['content'] $key $con}>
    <div class="tr"><div class="name"><{$key}>:</div><div class="con"><{$con}></div><div style="clear:both"></div></div><div style="clear:both"></div>
    <{/loop}>
        
    </div>
    <hr>
    <a href="<{url('Form/manage',array('formid'=>$fid))}>" class='left'>返回表单管理</a>
    <a href="<{url('Form/manage/del',array('id'=>$id))}>" class='right'>删除此内容</a>
</div>
<!-- script end -->
</body>
</html>