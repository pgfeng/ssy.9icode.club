<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> GouWanMei 站点管理</title>
    <{template 'Index/head'}>
    <style>
        .wrap {
            margin:30px;
        }
        table tr{
            border-bottom: 1px solid #e5e5e5;line-height: 35px;
        }
        table{
            width: 100%;
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
</head>
<body>
<div class="wrap">
    <div class="nav">
            <h1>站点管理</h1>
            <hr>
            <a href="" class="button button-primary"><i class="ico-plus"></i>新建站点</a>
    </div>
    <table class="table" id="website_manage" style="width: auto;">
        <thead>
        <tr>
            <th width="1" style="text-align:center">ID</th>
            <th width="150">名称</th>
            <th width="100">域名</th>
            <th width="100" style="text-align:center">模板</th>
            <th width="150" style="text-align:center">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align:center">1</td>
            <td>简约不简单</td>
            <td>http://9icode.net</td>
            <td style="text-align:center">default</td>
            <td style="text-align:center"><a href="" class="button">修改</a> <a href="" class="button button-danger">删除</a></td>
        </tr>
        </tbody>
    </table>
</div>
<{var_dump($_SERVER)}>