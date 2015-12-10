<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php view("Content/head"); ?>
<div class="wrap">
    <div style="height: 300px;background: #fff;margin-top:20px;line-height: 300px;">
        <h1 style="text-align: center;"><?php echo $message['content']; ?></h1>
    </div>
</div>
<?php if($locationhref) { ?>
<script>
    setTimeout("javascript:location.href='<?php echo isset($locationhref)?$locationhref:$this->var['locationhref'];?>'", 5000);
</script>
<?php } ?>
<?php view("Content/foot"); ?>