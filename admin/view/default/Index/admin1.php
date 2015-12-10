<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei 管理系统</title>
    <{template 'Index/head'}>
    <{includeStyle 'main-min.css'}>
</head>
<body>
<div class="header">
    <div class="dl-title">
        <!-- <a href="" title="文档库地址" target="_blank"> 链接 -->
        <span class="lp-title-port"></span><span class="dl-title-text">GouWanMei</span><small style="letter-spacing:1px;margin-left:10px;font-family:SimSun;font-size: 10px;">做就做不一样的CMS。</small>
        </a>
    </div>
    <div class="dl-log">欢迎您，<span class="dl-log-user"><{$username}></span><a href="<{url('Admin/loginout')}>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <ul id="J_Nav" class="nav-list ks-clear">
            <{PHP module('admin')->headnav($roleid);}>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">
    </ul>
</div>
<script>
    BUI.use('common/main', function () {
        var config =<php>module('admin')->adminmenu($roleid);</php>;
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>
</body>
</html>
