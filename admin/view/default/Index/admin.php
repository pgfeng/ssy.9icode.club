<!DOCTYPE HTML>
<html>
<head>
    <title> GouWanMei 管理系统</title>
    <{includeStyle "bs/css/bootstrap.min.css,bs/css/font-awesome.min.css,bs/css/animate.min.css,bs/css/style.min.css"}>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element" style="text-align:center;">
                            <span style="font-size:4em;color:#fff;">G</span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><{$realname}></strong></span>
                                <span class="text-muted text-xs block"><{$rolename}><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
    <!--                                 <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                                    </li>
                                    <li><a class="J_menuItem" href="profile.html">个人资料</a>
                                    </li>
                                    <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                                    </li>
                                    <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                                    </li>
                                <li class="divider"></li>-->
                                <li><a href="<{url('Admin/loginout')}>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">G
                        </div>
                    </li>
                    <{module('admin')->admin_nav($roleid)}>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:;"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" class="form-control" placeholder="请输入您需要查找的栏目 …" id="top-search" autocomplete="off" data-id="" style="border-radius: 4px;" alt="">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="" style="display: none;">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" style="padding-top: 0px; max-height: 375px; max-width: 800px; overflow: auto; width: auto; transition: 0.3s; min-width: 555px; left: -550px; right: auto; padding-right: 0px;"><table class="table table-condensed" style="margin-bottom: 0px;"><tbody><tr data-index="0" data-id="20001" data-key="淳芸"><td data-name="userName">淳芸</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20001</td></tr><tr data-index="1" data-id="20000" data-key="orion-01"><td data-name="userName">orion-01</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20000</td></tr><tr data-index="2" data-id="20002" data-key="穆晓晨"><td data-name="userName">穆晓晨</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20002</td></tr><tr data-index="3" data-id="20003" data-key="张欢引"><td data-name="userName">张欢引</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20003</td></tr><tr data-index="4" data-id="20004" data-key="吴琼"><td data-name="userName">吴琼</td><td data-name="shortAccount">wuqiong</td><td data-name="userId">20004</td></tr><tr data-index="5" data-id="20005" data-key="吴东鹏"><td data-name="userName">吴东鹏</td><td data-name="shortAccount">wudongpeng</td><td data-name="userId">20005</td></tr><tr data-index="6" data-id="20006" data-key="黄少铅"><td data-name="userName">黄少铅</td><td data-name="shortAccount">huangshaoqian</td><td data-name="userId">20006</td></tr><tr data-index="7" data-id="20007" data-key="胡运燕"><td data-name="userName">胡运燕</td><td data-name="shortAccount">yunyan</td><td data-name="userId">20007</td></tr><tr data-index="8" data-id="20008" data-key="刘幸"><td data-name="userName">刘幸</td><td data-name="shortAccount">liuxing</td><td data-name="userId">20008</td></tr><tr data-index="9" data-id="20009" data-key="陈媛媛"><td data-name="userName">陈媛媛</td><td data-name="shortAccount">chenyuanyuan</td><td data-name="userId">20009</td></tr><tr data-index="10" data-id="20010" data-key="旷东林"><td data-name="userName">旷东林</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20010</td></tr><tr data-index="11" data-id="20011" data-key="唐宏禹"><td data-name="userName">唐宏禹</td><td data-name="shortAccount">chunyun</td><td data-name="userId">20011</td></tr><tr data-index="12" data-id="20010" data-key="旷东林"><td data-name="userName">旷东林</td><td data-name="shortAccount">kuangdonglin</td><td data-name="userId">20010</td></tr><tr data-index="13" data-id="20011" data-key="唐宏禹"><td data-name="userName">唐宏禹</td><td data-name="shortAccount">tanghongyu</td><td data-name="userId">20011</td></tr></tbody></table></ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="J_menuTab" data-id="<{url('Index/station')}>">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<{url('Admin/loginout')}>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<{url('Index/station')}>" frameborder="0" data-id="<{url('Index/station')}>" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; CopyRight 2015  By <a href="http://WWW.9ICODE.NET/" target="_blank">PGF</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="index.html#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>
<!--                     <li class=""><a data-toggle="tab" href="index.html#tab-2">
                        通知
                    </a>
                    </li>
                    <li><a data-toggle="tab" href="index.html#tab-3">
                        项目进度
                    </a>
                    </li> -->
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="index.html#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="index.html#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="index.html#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
    </div>
    <{includeScript "bs/jquery.min.js,bs/bootstrap.min.js,bs/plugins/metisMenu/jquery.metisMenu.js,bs/plugins/suggest/bootstrap-suggest.min.js,bs/plugins/slimscroll/jquery.slimscroll.min.js,bs/plugins/layer/layer.min.js,bs/hplus.min.js,bs/contabs.min.js,bs/plugins/pace/pace.min.js"}>
    <script>
        $('#top-search').bsSuggest({url:'<{url("Content/serchCate/")}>?s=',getDataMethod:"url",allowNoKeyword:false,inputWarnColor:"#F3F3F4",idField:'cid',keyField:'catname',keyLeft:37,keyUp:38,keyRight:39,keyDown:40,keyEnter:13}).on('onSetSelectValue',function(e,keyword){console.log('onSetSelectValue: ',keyword);var s='<a href="javascript:;" class="active J_menuTab" data-id="<{url('Content/category/manage')}>">栏目管理 <i class="fa fa-times-circle"></i></a>';var r='<iframe class="J_iframe" name="iframe'+keyword.id+'" width="100%" height="100%" src="<{url("Content/content/manage")}>?cid='+keyword.id+'" frameborder="0" data-id="<{url('Content/category/manage')}>" seamless></iframe>';$(".J_menuTab").removeClass("active");$('.J_menuTab[data-id="<{url('Content/category/manage')}>"]').remove();$('.J_iframe[data-id="<{url('Content/category/manage')}>"]').remove();var loader=layer.load();$(".J_menuTabs .page-tabs-content").append(s);$(".J_mainContent").find("iframe.J_iframe").hide().parents(".J_mainContent").append(r);$('#top-search').val('');$('.J_iframe[data-id="<{url('Content/category/manage')}>"]').load(function(){layer.close(loader)});$("#top-search").blur()});
    </script>
</body>
</html>
