<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<div class="wrap">
    <div class="ucenter">
        <?php view("Member/left_bar"); ?>
        <div class="right">
            <div class="top"><?php echo $user['nickername'];?>，你好！</div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php view("Content/foot"); ?>