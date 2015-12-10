<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei_后台管理系统</title>
    <{template 'Index/head'}>
    <style type="text/css">
        code {
            padding: 0px 4px;
            color: #d14;
            background-color: #f7f7f9;
            border: 1px solid #e1e1e8;
        }

        .wrap {
            padding: 50px 50px;
        }

        td.text-right {
            text-align: right;
        }

        td.text-left {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="row">
        <div class="span21 offset1 doc-content">
            <table cellspacing="0" class="table table-bordered">
                <tbody>
                <tr>
                    <td class="text-right span3">你好，</td>
                    <td colspan="2" class="text-left"><{$realname}></td>
                    <td class="text-right span3">所属角色：</td>
                    <td colspan="2" colspan="2" class="text-left"><{$rolename}></td>
                </tr>
                <tr>
                    <td class="text-right">上次登录时间：</td>
                    <td colspan="2" class="text-left"><{date("Y-m-d H:i:s",$lastlogintime)}></td>
                    <td class="text-right">上次登录IP：</td>
                    <td colspan="2"><{$lastloginip}></td>
                </tr>
                <tr>
                    <td class="text-right">操作系统：</td>
                    <td colspan="2" class="text-left"><{PHP_OS}></td>
                    <td class="text-right">运行环境：</td>
                    <td colspan="2"><{$_SERVER['SERVER_SOFTWARE']}></td>
                </tr>
                <tr>
                    <td class="text-right">MySQL 版本：</td>
                    <td colspan="2" class="text-left">
                        <{model()->version()}>
                    </td>
                    <td class="text-right">上传文件：</td>
                    <td colspan="2" class="text-left"><{php echo ini_get('upload_max_filesize');}></td>
                </tr>
                <tr>
                    <td class="text-right">PHP 版本：</td>
                    <td colspan="2" class="text-left">
                        <php>echo phpversion();</php>
                        <{phpversion()}>
                    </td>
                    <td class="text-right">缓存驱动：</td>
                    <td colspan="2" class="text-left"><{php echo Config::cache('driver');}></td>
                </tr>
                <tr>
                    <td class="text-right">路由驱动：</td>
                    <td colspan="2" class="text-left">
                        <{php echo Config::router('driver');}>
                    </td>
                    <td class="text-right">数据库驱动：</td>
                    <td colspan="2" class="text-left"><{php echo Config::database('driver');}></td>
                </tr>
                <tr>
                    <td class="text-right">版权所有：</td>
                    <td colspan="2" class="text-left">济宁亿佰网络</td>
                    <td class="text-right">作 者：</td>
                    <td colspan="2" class="text-left">PGF</td>
                </tr>
                <tr>
                    <td class="text-right">程序版本：</td>
                    <td colspan="2" class="text-left">1.0</td>
                    <td class="text-right">register_globals：</td>
                    <td colspan="2" class="text-left">
                        <php>
                            $ini=ini_get_all();
                            echo
                            isset($ini['register_globals'])?($ini['register_globals']=='On'||$ini['register_globals']=='1')?'On':'Off':'Off';
                        </php>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">magic_quotes_gpc：</td>
                    <td colspan="2" class="text-left"><{php echo get_magic_quotes_gpc()==1?'On':'Off';}></td>
                    <td class="text-right">magic_quotes_runtime：</td>
                    <td colspan="2" class="text-left"><{php echo get_magic_quotes_runtime()>0?get_magic_quotes_runtime():0;}>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>