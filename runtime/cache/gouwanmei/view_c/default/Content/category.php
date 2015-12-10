<?php defined('APP_PATH') or exit('Sorry,Please from entry!'); ?>
<?php $CAT=CATBC($cid,1)?>
<?php if(is_array($CAT)) foreach($CAT AS $cat) { ?>
<?php echo header('Location:'.$cat['url']);?>
<?php echo exit();?>
<?php } ?>