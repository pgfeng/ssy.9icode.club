<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php if($loginstatus!=0) { ?>
<?php if($loginstatus==1) { ?>
<div>
    对不起，您的账号密码不匹配！
</div>
<?php } elseif ($loginstatus==2) { ?>
<div>
    对不起，验证码不正确！
</div>
<?php } ?>
<div class="wrap">
    <div class="login">
        <form action="<?php echo get_url();?>" id="loginform" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="text" name="checkcode"><img src="<?php echo URL('Use/checkcode');?>" alt="">
            <input type="submit" value="登陆">
        </form>
    </div>
</div>
<?php } else { ?>
    登陆成功了！！！
<?php } ?>
<?php view("Content/foot"); ?>