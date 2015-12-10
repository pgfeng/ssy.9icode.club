<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<?php echo isset($registerstatus)?$registerstatus:$this->var['registerstatus'];?>
<div class="wrap">
    <form action="<?php echo get_url();?>" method="post">
        <input type="text" name="username" placeholder="账号"><br>
        <input type="text" name="nickername" placeholder="昵称"><br>
        <input type="email" name="email" placeholder="邮箱"><br>
        <input type="password" name="password" placeholder="密码"><br>
        <input type="password" name="password_again" placeholder="重复密码"><br>
       
        <?php if($website['registercheckcode']==1) { ?>
            <input type="text" name="checkcode"><img src="<?php echo url('Use/checkcode');?>" alt="">
        <?php } ?>
        <input type="submit" value="注册">
    </form>
</div>
<?php view("Content/foot"); ?>