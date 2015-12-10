<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>您需要登录后才可以使用本功能</title>
    <script type="text/javascript" src="/admin/public/js/jquery-1.8.1.min.js"></script>
    <link href="/admin/public/css/login.css" type="text/css" rel="stylesheet">
    <style type="text/css">
        body {
            background-color: #666666;
            background-image: url("");
            background-repeat: no-repeat;
            background-position: center top;
            background-attachment: fixed;
            background-clip: border-box;
            background-size: cover;
            background-origin: padding-box;
            width: 100%;
            padding: 0;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function(){
        //Random background image
        var random_bg=Math.floor(Math.random()*5+1);
        var bg='url(<?php echo $view_vars['public_path'];?>img/login/bg_'+random_bg+'.jpg)';
        $("body").css("background-image",bg);
        //Hide Show verification code
        $("#hide").click(function(){
            $(".code").fadeOut("slow");
        });
        $("#captcha").focus(function(){
            $(".code").fadeIn("fast");
        });
        //跳出框架在主窗口登录
        if(top.location!=this.location)	top.location=this.location;
        $('#user_name').focus();
        //$("#captcha").nc_placeholder();
    });
</script>
<div class="bg-dot"></div>
<div class="login-layout">
    <div class="top">
        <h5><em></em></h5>
        <h2>GouWanMei CMS管理中心</h2>
    </div>
    <div class="box">
        <form method="post" id="form_login" ACTION="<?php echo url('Admin/login');?>">
      <span>
      <label>账号</label>
      <input name="username" id="user_name" autocomplete="off" type="text" class="input-text" required>
      </span> <span>
      <label>密码</label>
      <input name="password" id="password" class="input-password" autocomplete="off" type="password" required pattern="[\S]{6}[\S]*"
             title="密码不少于6个字符">
      </span> <span>
      <div class="code">
          <div class="arrow"></div>
          <div class="code-img"><img src="<?php echo url('Use/checkcode');?>" name="codeimage" id="codeimage" border="0"/></div>
          <a href="JavaScript:void(0);" id="hide" class="close" title="关闭"><i></i></a><a href="JavaScript:void(0);" onclick="javascript:document.getElementById('codeimage').src='<?php echo url('Use/checkcode');?>?&t=' + Math.random();" class="change" title="看不清,点击更换验证码"><i></i></a> </div>
      <input name="checkcode" type="text" required class="input-code" id="captcha" placeholder="输入验证" pattern="[A-z0-9]{4}" title="验证码为4个字符" autocomplete="off" value="" >
      </span> <span>
      <input name="" class="input-button" type="submit" value="登录">
      </span>
        </form>
    </div>
</div>
<div class="bottom">
</div>
</body>
</html>